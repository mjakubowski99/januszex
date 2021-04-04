<?php


namespace app\controllers;
use app\facades\Auth;
use app\models\Address;
use app\facades\ResponseStatus;
use app\facades\Filters;
use app\validators\AddressValidator;


class AddressController extends Controller
{

    public function index(){
        //Auth::simulate('user@example.com');

        if( !Auth::isLogged() )
            ResponseStatus::code(401);


        $address = Address::getAuthUserAddress();
        if( $address !== null )
            echo json_encode($address);
        else
            echo json_encode(['message' => 'Ten uzytkownik nie ma przypisanego adresu']);
    }

    public function test(){
        //Auth::simulate('user@example.com');

        if( !Auth::isLogged() )
            ResponseStatus::code(401);

        $this->view('address');
    }

    public function store(){
        //Auth::simulate('user@example.com');

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
            echo json_encode(['message' => 'Success']);
        }
        else {
            echo json_encode(['message' => $message]);
        }

    }

}