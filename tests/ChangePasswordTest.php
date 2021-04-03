<?php declare(strict_types=1);
require __DIR__.'/../autoloader.php';

use PHPUnit\Framework\TestCase;
use app\controllers\ChangePasswordController;
use app\config\JwtManage;
use app\validators\ChangePasswordValidator;
use app\database\Database;
use GuzzleHttp\Client;

final class ChangePasswordTest extends TestCase
{
    public function setPostData($data){
        foreach( $data as $key => $value )
            $_POST[$key] = $value;
    }

    public function testNotAuthorizedUserGetError(): void
    {
        $guzzle = new Client(['http_errors' => false ]);

        $response = $guzzle->request('POST', 'http://localhost/changePassword');
        $this->assertSame(401, $response->getStatusCode() );
    }

}