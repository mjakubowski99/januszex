<?php declare(strict_types=1);

require __DIR__.'/../autoloader.php';
require __DIR__.'/../creator/RefreshDatabase.php';

use PHPUnit\Framework\TestCase;
use app\config\JwtManage;
use app\database\Database;
use app\models\Address;
use app\facades\Auth;


final class ApiResponseTests extends TestCase
{
    public function genToken(){
        $db = new Database();
        $row = $db->execute("SELECT name FROM administrators LIMIT 1");

        $jwt = new JwtManage('admin');

        return "Bearer ".$jwt->createToken($row['name']);
    }

    public function genAdminToken(){
        $db = new Database();
        $row = $db->execute("SELECT email FROM users LIMIT 1");
        $jwt = new JwtManage('email');

        return "Bearer ".$jwt->createToken($row['email']);
    }

   public function testAdminCustomersOrders(){

       $client = new GuzzleHttp\Client();
       $res = $client->request('POST', 'http://localhost/admin/customers', [
           'headers' => [
               'Authorization' => $this->genToken()
           ]
       ]);

       $this->assertEquals( 200, $res->getStatusCode() );
   }

    public function testAdminOrderDetails(){

        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'http://localhost/admin/orderdetails', [
            'headers' => [
                'Authorization' => $this->genToken()
            ],
            'form_params' => [
                'order_id' => 1
            ]
        ]);

        $this->assertEquals( 200, $res->getStatusCode() );
    }

    public function testAdminOrders(){
        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'http://localhost/admin/orderdetails', [
            'headers' => [
                'Authorization' => $this->genToken()
            ],
        ]);

        $this->assertEquals( 200, $res->getStatusCode() );
    }

    public function testAdminProducts(){
        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'http://localhost/admin/products', [
            'headers' => [
                'Authorization' => $this->genToken()
            ],
        ]);

        $this->assertEquals( 200, $res->getStatusCode() );
    }

    public function testProducts(){
        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'http://localhost/products', [
            'headers' => [
                'Authorization' => $this->genToken()
            ],
        ]);

        $this->assertEquals( 200, $res->getStatusCode() );
    }

    public function testProduct(){
        $client = new GuzzleHttp\Client();

        $res = $client->request('POST', 'http://localhost/products/1', [
            'headers' => [
                'Authorization' => $this->genToken()
            ],
        ]);

        $this->assertEquals( 200, $res->getStatusCode() );
    }

}