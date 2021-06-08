<?php


namespace app\controllers;

use app\facades\ResponseStatus;
use app\models\Payment;
use app\validators\PaymentValidator;
use app\facades\Auth;
use app\facades\Json;

class PaymentController extends Controller
{
    public function index(){
        $this->view('paymentTest');
    }

    public function create(){
        //Auth::simulate("Jan.Kowalski@gmail.com");
        if( !Auth::isLogged() )
            ResponseStatus::code(401);

        $validator = new PaymentValidator();

        if( $validator->validate($_POST) ){
            $email = Auth::email();

            $response = Payment::create($_POST['products'], $email);
            header('Location:'.$response->getResponse()->redirectUri);
        }
        else{
            Json::response([
                "status" => "error",
                "message" =>  $validator->getMessage()
            ]);
        }
    }

    public function retrieve(){

    }
}