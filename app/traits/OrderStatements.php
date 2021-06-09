<?php

namespace app\traits;

trait OrderStatements{

    static function insertOrderStatement(): string{
        return "
            INSERT INTO orders(
                payu_ext_order_id, payu_order_id, 
                user_id, address_id, order_date, 
                full_amount, status
            )
            VALUES(:payu_ext_order_id, :payu_order_id, :user_id, :address_id, :order_date, :full_amount, :status)
        ";
    }

    static function insertOrderPartsStatement(): string{
        return "
            INSERT INTO orders_parts(
                product_id, order_id,
                quantity
            )
            VALUES(:product_id, :order_id, :quantity)
        ";
    }

}