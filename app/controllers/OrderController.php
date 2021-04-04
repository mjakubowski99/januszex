<?php


namespace app\controllers;
use app\facades\Auth;
use app\facades\ResponseStatus;
use app\models\Order;


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
}