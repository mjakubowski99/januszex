<?php


namespace app\models;
use app\Facades\Auth;
use app\resource\OrdersResource;

class Order extends Model
{
    public static function table(): string{
        return 'orders';
    }

    public static function getOrdersForAuthUser(){
        $email = Auth::email();
        $resource = new OrdersResource();

        return $resource->getOrdersForEmail($email);
    }
}