<?php

namespace app\models;

class User extends Model{

    public static function table(): string
    {
        return 'users';
    }
}