<?php


namespace app\models;


class Product extends Model
{
    public static function table(): string{
        return "products";
    }
}