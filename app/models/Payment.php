<?php


namespace app\models;


use app\config\DotEnv;
use OpenPayU_Configuration;
use OpenPayU_Order;

class Payment
{

    public static function create($products, $email){
        ( new DotEnv(__DIR__.'/../../.env') )->load();

        $order['continueUrl'] = getenv('PAYU_CONTINUE_URL'); //customer will be redirected to this page after successfull payment
        $order['notifyUrl'] = getenv('PAYU_NOTIFY_URL');
        $order['customerIp'] = $_SERVER['REMOTE_ADDR'];
        $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();

        $order['description'] = 'New order';
        $order['currencyCode'] = 'PLN';

        $order['extOrderId'] = base64_encode( random_bytes(15) );

        $i = 0;
        $amount = 0;
        foreach($products as $product){
            $order['products'][$i]['name'] = $product['id'];
            $order['products'][$i]['unitPrice'] = 100;
            $order['products'][$i]['quantity'] = $product['quantity'];

            $amount += (100 * intval($product['quantity']) );
            $i++;
        }

        $order['totalAmount'] = $amount;

        //optional section buyer
        $order['buyer']['email'] = $email;

        return OpenPayU_Order::create($order);
    }
}