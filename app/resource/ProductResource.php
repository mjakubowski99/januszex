<?php


namespace app\resource;


class ProductResource extends Resource
{
    public function getProductPriceById($productId){
        $query = "SELECT price FROM products WHERE id=:id";
        $values = ['id' => $productId];


        $row = $this->database->execute($query,$values);
        if( !$row )
            return null;
        return $row['price'];
    }
}