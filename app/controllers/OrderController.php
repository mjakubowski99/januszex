<?php


namespace app\controllers;
use app\database\Database;
use app\facades\Auth;
use app\facades\ResponseStatus;
use app\models\Order;
use app\resource\OrdersResource;
use app\resource\UserResource;
use OpenPayU_Order;
use app\facades\Json;


class OrderController extends Controller
{
    public function index(){
        //Auth::simulate('user@example.com');
        if( !Auth::isLogged() )
            ResponseStatus::code(401);

        $orders = Order::getOrdersForAuthUser();
        if( $orders === null )
            echo json_encode(['message' => 'No orders for this user']);
        else
            echo json_encode($orders);
    }

    public function retrieve(){
        $order_id = $_GET['order_id'];

        $response = OpenPayU_Order::retrieve($order_id);
        $status = $response->getResponse()->orders[0]->status;

        Order::updateStatus($order_id, $status);

        Json::response([
            'status' => $status,
            'products' => $response->getResponse()->orders[0]->products
        ]);
    }

    public function lastOrder(){
        if( !Auth::isLogged() ){
            ResponseStatus::code(403);
        }
        $user_id = ( new UserResource() )->getUserByEmail( Auth::email() )['id'];

        $database = new Database();
        $row = $database->execute("SELECT * FROM orders WHERE id = (
            SELECT max(id) FROM orders WHERE user_id = :user_id
        )", ['user_id' => $user_id] );

        echo Json::response($row);
    }

    private function getAddressQuery(){
        return "
            select 
            users.name, 
            users.surname, 
            address.street,
            address.home_number, 
            address.flat_number, 
            address.postoffice_code, 
            address.city
            from orders
            INNER JOIN address
            ON orders.address_id = address.ID
            INNER JOIN users
            ON orders.user_id = users.ID 
            WHERE orders.ID = :order_id
        ";
    }

    public function getProductsQuery(){
        return "
            select 
            orders_parts.product_id,
            products.product_name,
            orders_parts.quantity, 
            products.price
            FROM orders
            INNER JOIN  orders_parts
            ON orders.ID = orders_parts.order_id
            INNER JOIN products
            ON orders_parts.product_id = products.ID
            WHERE orders.ID = :order_id
        ";
    }


    public function showDetails(){
        if( !Auth::isLogged() ){
            ResponseStatus::code(403);
        }

        $database = new Database();
        $orderID = strip_tags($_POST["orderId"]);

        $user_id = ( new UserResource() )->getUserByEmail( Auth::email() )['id'];

        $values = [':order_id' => $orderID, ':user_id' => $user_id];

        $sql = "SELECT 
                orders.ID, 
                orders.order_date,
                orders.user_id, 
                orders.status,
                orders.full_amount
                FROM orders
                INNER JOIN  orders_parts
                ON orders.ID = orders_parts.order_id
                INNER JOIN products
                ON orders_parts.product_id = products.ID
                WHERE orders.ID = :order_id AND
                 orders.user_id = :user_id
                GROUP BY orders.ID";


        $order = $database->executeMany($sql, $values); //to get first row
        if( count($order) === 0)
            return json_encode($order);

        $values = [':order_id' => $orderID];

        $order = $order[0];
        $address = $database->executeMany( $this->getAddressQuery(), $values );
        $products = $database->executeMany( $this->getProductsQuery(), $values );

        $order['address'] = $address;
        $order['products'] = $products;

        echo json_encode($order);
    }
}