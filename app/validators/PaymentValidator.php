<?php


namespace app\validators;

use app\models\Product;


class PaymentValidator extends Validator
{

    public function getErrorMessages(){
        return $this->message;
    }

    public function validate($data){
        if( !isset($data->products) || !is_array($data->products) ){
            $this->message = 'Produkty musisz przekazac w tablicy!';
            return false;
        }

        $ids = Product::ids();
        $products = $data->products;

        if( count($products) > 50 ){
            $this->message = "Zwariowales?";
            return false;
        }

        foreach( $products as $product ){
            if(
                !isset($product->id)
                || !isset($product->quantity)
            ){
                $this->message = 'Każdy element tablicy musi mieć określone id i ilość';
                return false;
            }


            $in_array = false;
            foreach( $ids as $row){
                if( in_array($product->id, $row) ){
                    $in_array = true;
                }
            }

            if( !$in_array ){
                $this->message = "Produkt o id: ".$product->id." nie istnieje";
                return false;
            }

            if( !ctype_digit( strval($product->quantity) ) ){
                $this->message = 'Podana ilosc: '.$product->quantity.' jest nieprawidlowa liczba';
                return false;
            }

            $quantity = intval($product->quantity);
            if( $quantity <= 0 || $quantity >= 500){
                $this->message = "Podana ilość: ".$quantity." jest nieprawidłowa";
                return false;
            }

        }

        return true;
    }
}