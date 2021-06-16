<?php


namespace app\controllers;

use app\facades\ResponseStatus;

use app\models\Payment;
use app\models\Order;

use app\resource\OrdersResource;
use app\validators\PaymentValidator;
use app\facades\Auth;
use app\facades\Json;

use OpenPayU_Order;

class PaymentController extends Controller
{
    public function index(){
        $this->view('paymentTest');
    }

    public function create(){
        Auth::simulate("Jan.Kowalski@wp.pl");
        if( !Auth::isLogged() )
            ResponseStatus::code(401);

        $validator = new PaymentValidator();
        $data = Json::receive();

        if( $validator->validate($data) ){
            $email = Auth::email();
            $response = Payment::create($data->products, $email);
            Order::create( Payment::$lastOrder, $response->getResponse()->orderId );

            Json::response([
                "status" => "error",
                "message" =>  $response->getResponse()->redirectUri
            ]);
        }
        else{
            Json::response([
                "status" => "error",
                "message" =>  $validator->getMessage()
            ]);
        }
    }

    public function notify(){
        file_put_contents('log.txt', 1);

        $orderResource = new OrdersResource();

        $body = file_get_contents('php://input');
        $data = trim($body);

        file_put_contents('log.txt', $data);

        $response = OpenPayU_Order::consumeNotification($data);

    }
}