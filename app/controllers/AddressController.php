<?php


namespace app\controllers;
use app\facades\Auth;
use app\models\Address;
use app\facades\ResponseStatus;
use app\facades\Filters;
use app\validators\AddressValidator;
use app\facades\Json;


class AddressController extends Controller
{

    public function index(){
        //Auth::simulate('user10@example.com');

        if( !Auth::isLogged() )
            ResponseStatus::code(401);


        $address = Address::getAuthUserAddress();
        if( $address !== null )
            Json::response($address);
        else
            echo Json::response(['message' => 'Ten uzytkownik nie ma przypisanego adresu']);
    }

    public function test(){
        //Auth::simulate('user10@example.com');

        if( !Auth::isLogged() )
            ResponseStatus::code(401);

        $this->view('address');
    }

    public function store(){
        //Auth::simulate('user10@example.com');

        if( !Auth::isLogged() )
            ResponseStatus::code(401);
        Filters::stripTags($_POST);

        $validator = new AddressValidator();
        $message = $validator->validate($_POST);

        if( $message === true ) {
            Address::update([
                'city' => $_POST['city'],
                'street' => $_POST['street'],
                'home_number' => $_POST['home_number'],
                'flat_number' => $_POST['flat_number'],
                'postoffice_name' => $_POST['postoffice_name'],
                'postoffice_code' => $_POST['postoffice_code']
            ], [
                'id' => Address::getAuthUserAddressId()
            ]);
            echo Json::response(['message' => 'Success']);
        }
        else {
            echo Json::response(['message' => $message]);
        }

    }

}