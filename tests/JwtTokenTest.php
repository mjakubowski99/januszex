<?php declare(strict_types=1);
require __DIR__.'/../autoloader.php';

use PHPUnit\Framework\TestCase;
use app\config\JwtManage as JwtManage;
use Firebase\JWT\JWT;
use app\config\DotEnv;

final class JWTTokenTest extends TestCase
{
    public function testTokenNotExistInHeader(): void
    {
        $jwt = new JwtManage('user');
        $this->assertSame( $jwt->tokenExistInHeader(), false);
    }

    public function testTokenExistInHeader(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer 1234";
        $jwt = new JwtManage('user');
        $this->assertSame( $jwt->tokenExistInHeader(), true);
    }

    public function testTokenExistInHeaderBotBearerNotValid(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearerr 1234";
        $jwt = new JwtManage('user');
        $this->assertSame( $jwt->tokenExistInHeader(), false);
    }

    public function testThereIs_HTTP_AUTHORIZATION_SetButNoToken(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer ";
        $jwt = new JwtManage('user');
        $this->assertSame( $jwt->tokenExistInHeader(), false);
    }

    public function testAbleToExtractToken(): void
    {
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer 1234";
        $jwt = new JwtManage('user');
        $jwt->tokenExistInHeader();

        $this->assertSame( $jwt->ableToExtractToken(), true);
    }

    public function testTokenHasValidSignatureAndNotExpired(){
        $jwt = new JwtManage('user');
        ( new DotEnv(__DIR__.'/../.env') )->load();

        $token = $jwt->createToken('user@example.com');
        $secret = getenv("JWT_SECRET");
        $token = JWT::decode($token, $secret, ['HS512']);

        $this->assertTrue( $jwt->tokenHasValidSignatureAndNotExpired($token) );
    }

    public function testTokenExpired(){
        $jwt = new JwtManage('user');
        ( new DotEnv(__DIR__.'/../.env') )->load();

        $token = $jwt->createToken('user@example.com');
        $secret = getenv("JWT_SECRET");
        $token = JWT::decode($token, $secret, ['HS512']);

        $now = ( new \DateTimeImmutable() )->modify('+3 hours'); //check how much time is to expire for token

        $this->assertTrue( $token->exp < $now->getTimestamp() );
    }



}