<?php


namespace app\models;
use app\config\DatabaseConnector;
use app\Facades\Auth;
use app\resource\OrdersResource;
use app\resource\UserResource;
use app\traits\OrderStatements;

class Order extends Model
{
    use OrderStatements;

    public static function table(): string{
        return 'orders';
    }

    public static function getOrdersForAuthUser(){
        $email = Auth::email();
        $resource = new OrdersResource();

        return $resource->getOrdersForEmail($email);
    }

    public static function insertOrderParts(& $dbh, & $orderInfo, $orderId){
        $products = $orderInfo['products'];

        foreach($products as $product){
            $values = [
                'order_id' => $orderId,
                'product_id' => $product['name'], //id is assigned as a name
                'quantity' => $product['quantity']
            ];

            $stmt = $dbh->prepare( OrderStatements::insertOrderPartsStatement() );
            $stmt->execute($values);
        }
    }

    public static function create($orderInfo, $payuOrderId){
        $dbh = ( new DatabaseConnector() )->getConnection();
        $userResource = new UserResource();

        $dbh->beginTransaction();

        $user = $userResource->getUserByEmail( $orderInfo['buyer']['email'] );

        $orderValues = [
            'payu_ext_order_id' => $orderInfo['extOrderId'],
            'payu_order_id' => $payuOrderId,
            'user_id' => $user['id'],
            'address_id' => $user['address_id'],
            'order_date' => null,
            'full_amount' => $orderInfo['totalAmount'],
            'status' => 'Nieoplacone',
        ];

        try{
            //Step 1 insert to orders array
            $stmt = $dbh->prepare(OrderStatements::insertOrderStatement());
            $stmt->execute($orderValues);
            $orderId = $dbh->lastInsertId();

            //Step 2 insert order parts to order_parts
            self::insertOrderParts($dbh, $orderInfo, $orderId);

            $dbh->commit();
        }
        catch(\Exception $ex){
            var_dump($ex);
          if ($dbh->inTransaction())
              $dbh->rollBack();
        }
    }

    public static function updateStatus($payuOrderId, $status){
        static::tryToSetDatabase();
        $db = static::$database;

        $db->update("UPDATE orders SET status=:status WHERE payu_order_id=:order_id", [
            'status' => $status,
            'order_id' => $payuOrderId
        ]);
    }
}