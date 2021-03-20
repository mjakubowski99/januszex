<?php declare(strict_types=1);
require __DIR__.'/../autoloader.php';

use PHPUnit\Framework\TestCase;
use app\config\JwtManage as JwtManage;

final class JWTTokenTest extends TestCase
{
    public function testTokenNotExistInHeader(): void
    {
        $jwt = new JwtManage();
        $this->assertSame( $jwt->tokenExistInHeader(), false);
    }

    public function testTokenExistInHeader(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer 1234";
        $jwt = new JwtManage();
        $this->assertSame( $jwt->tokenExistInHeader(), true);
    }

    public function testTokenExistInHeaderBotBearerNotValid(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearerr 1234";
        $jwt = new JwtManage();
        $this->assertSame( $jwt->tokenExistInHeader(), false);
    }

    public function testThereIs_HTTP_AUTHORIZATION_SetButNoToken(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer ";
        $jwt = new JwtManage();
        $this->assertSame( $jwt->tokenExistInHeader(), false);
    }

    public function testAbleToExtractToken(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer 1234";
        $jwt = new JwtManage();
        $jwt->tokenExistInHeader();

        $this->assertSame( $jwt->ableToExtractToken(), true);
    }



}