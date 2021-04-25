<?php


namespace app\validators;

use app\config\DotEnv;

require_once(__DIR__.'/../../vendor/autoload.php');

class AdminLoginValidator extends Validator
{
    public function checkPasswordValid($password, $hash){
        return password_verify($password, $hash);
    }

    public function findAdminByName($name){
        $query = "SELECT name, password FROM administrators WHERE name=:name";
        $values = [ 'name' => $name ];

        return $this->database->execute($query, $values);
    }


    public function validate($data): bool
    {
        ( new DotEnv(__DIR__.'/../../.env') )->load();

        if (empty($data['name']))
            return "Wypełnij pole email";
        if (empty($data['password']))
            return "Wypełnij pole hasło";

        $row =  $this->findAdminByName( $data['name'] );

        if( !$row )
            return false;
        else if( $this->checkPasswordValid($data['password'], $row['password'] )
                 && $data['secret'] === getenv('ADMIN_CODE') )
            return true;
        return false;
    }
}