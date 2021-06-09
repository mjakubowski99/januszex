<?php


namespace app\controllers;
use app\facades\Auth;
use app\facades\ResponseStatus;
use app\models\Order;
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
}