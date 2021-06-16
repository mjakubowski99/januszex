<?php declare(strict_types=1);

require __DIR__.'/../autoloader.php';
require __DIR__.'/../creator/RefreshDatabase.php';

use PHPUnit\Framework\TestCase;
use app\config\JwtManage;
use app\database\Database;
use app\models\Address;
use app\facades\Auth;


final class AddressChangeTest extends TestCase
{
    public function testNotAuthorizedUserGetError(): void
    {
        $guzzle = new GuzzleHttp\Client(['http_errors' => false ]);

        $response = $guzzle->request('POST', 'http://localhost/changeAddress');
        $this->assertSame(401, $response->getStatusCode() );
    }

    public function testGetAuthAddressFromAddressModelReturnAddress(){
        $refresh = new RefreshDatabase();
        $refresh->refresh();

        $db = new Database();
        $row = $db->execute("SELECT email FROM users LIMIT 1");

        Auth::simulate($row['email']);
        $address = Address::getAuthUserAddress();

        $assertion = array_key_exists('street', $address) && array_key_exists('city', $address)
            && array_key_exists('home_number', $address) && array_key_exists('flat_number', $address)
            && array_key_exists('postoffice_name', $address) && array_key_exists('postoffice_code', $address);

        $this->assertTrue($assertion);

        Auth::unsimulate();
        $refresh->refresh();
    }

    public function testGetAuthAddressFromAddressModelDonTReturnAddressForNotAuth(){
        $address = Address::getAuthUserAddress();

        $this->assertNull($address);
    }

    public function testSuccessfulPasswordChange(){
        $refresh = new RefreshDatabase();
        $refresh->refresh();

        $jwt = new JwtManage('user');
        $db = new Database();
        $row = $db->execute("SELECT email FROM users LIMIT 1");

        $token = $jwt->createToken( $row['email'] );

        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'http://localhost/changeAddress', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
            'form_params' => [
                'city' => 'Poland',
                'street' => 'Glucha 21',
                'home_number' => '10',
                'flat_number' => '10',
                'postoffice_name' => 'Prokopow',
                'postoffice_code' => '20-000',
            ]
        ]);

        $refresh = new RefreshDatabase();
        $refresh->refresh();

        $message =  strval( $res->getBody() );

        $this->assertTrue( strpos($message, 'Success') !== false );

    }

}