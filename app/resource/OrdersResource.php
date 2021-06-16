<?php


namespace app\resource;

class OrdersResource extends Resource
{
    public function getIdForEmail($email){
        $query = "SELECT id FROM users WHERE email=:email";
        $values = [ 'email' => $email ];

        $row = $this->database->execute($query, $values);
        if( !$row )
            return null;

        return $row['id'];
    }

    public function getOrdersForEmail($email){
        $user_id = $this->getIdForEmail($email);
        if( $user_id === null )
            return null;


        $query = "SELECT orders.id, orders_parts.order_id, orders.order_date, 
                  SUM( products.price * orders_parts.quantity) as price, orders.status
                  FROM orders_parts
                  LEFT JOIN orders ON orders_parts.order_id = orders.id
                  LEFT JOIN products ON orders_parts.product_id = products.id
                  WHERE user_id=:user_id
                  GROUP BY orders_parts.order_id
                  ";
                  
        $values = [ 'user_id' => $user_id ];
        $rows = $this->database->executeMany($query, $values);

        if( count($rows) === 0 )
            return null;
        return $rows;
    }

    public function getOrderByPayuId($payuOrderId){
        $query = "SELECT id FROM order WHERE payu_order_id=:payu_order_id";

        $values = ['payu_order_id' => $payuOrderId];
        $row = $this->database->execute($query, $values);

        if( !$row )
            return null;
        return $row['id'];
    }

}