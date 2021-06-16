<?php

namespace app\traits;

trait GeneratePasswordForUser{

    function generateRandomPassword(): string{
        $length = rand(11, 15);

        return bin2hex( random_bytes($length) );
    }

}