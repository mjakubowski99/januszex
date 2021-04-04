<?php


namespace app\validators;
use app\facades\Auth;
use app\resource\UserResource;


class ChangePasswordValidator extends Validator
{

    public function lengthValid($string, $length){
        return strlen($string) > $length;
    }

    public function validate($data): bool{
        $email = Auth::email();
        $password = $data['actual-password'];

        $resource = new UserResource();
        if( $resource->getPasswordRow($email, $password) === null ) {
            $this->message = ['message' => 'Invalid password'];
            return false;
        }

        if( $data['new-password'] !== $data['repeat-new-password'] ) {
            $this->message = ['message' => 'Passwords are not the same'];
            return false;
        }

        if( !$this->lengthValid($data['new-password'], 8) ){
            $this->message = ['message' => 'Password is too short'];
            return false;
        }

        if( $data['actual-password'] === $data['new-password'] ){
            $this->message = ['message' => 'New password is exact same'];
            return false;
        }

        return true;
    }
}