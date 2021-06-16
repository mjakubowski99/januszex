<?php

namespace app\models;
use app\facades\Auth;
use app\resource\AddressResource;

class Address extends Model{

    public static function table(): string{
        return 'address';
    }

    public static function getAuthUserAddress(){
        $email = Auth::email();
        $resource = new AddressResource();

        return $resource->getAddressForUser($email);
    }

    public static function getAuthUserAddressId(){
        $email = Auth::email();
        $resource = new AddressResource();

        return $resource->getAddressIdForUser($email)['id'];
    }
}