<?php


namespace app\models;


use app\config\DotEnv;
use app\resource\ProductResource;
use OpenPayU_Configuration;
use OpenPayU_Order;

class Payment
{

    public static $lastOrder;

    public static function create($products, $email){
        ( new DotEnv(__DIR__.'/../../.env') )->load();

        $productResource = new ProductResource();

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
            $price = $productResource->getProductPriceById($product->id);

            $order['products'][$i]['name'] = $product->id; //id is assigned as a name
            $order['products'][$i]['unitPrice'] = $price;
            $order['products'][$i]['quantity'] = $product->quantity;

            $amount += (100 * $price * intval($product->quantity) );
            $i++;
        }

        $order['totalAmount'] = $amount;

        //optional section buyer
        $order['buyer']['email'] = $email;

        self::$lastOrder = $order;

        return OpenPayU_Order::create($order);
    }
}