<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once '../app/config/VerifyToken.php';

final class VerifyTokenTest extends TestCase
{
    public function testTokenNotExpiredGiveTrue(): void
    {
        $verifyToken = new VerifyToken();

        $twoHoursFromNow = ( new DateTime() )->modify('+2 hours');
        $twoHoursFromNow = $twoHoursFromNow->format('Y-m-d H:i:s');

        $this->assertSame( $verifyToken->tokenNotExpired($twoHoursFromNow), true);
    }

    public function testTokenExpiredGiveFalse(): void{
        $verifyToken = new VerifyToken();

        $twoHoursBefore = ( new DateTime() )->modify('-2 hours');
        $twoHoursBefore = $twoHoursBefore->format('Y-m-d H:i:s');

        $this->assertSame( $verifyToken->tokenNotExpired($twoHoursBefore), false);
    }

    public function testTokenExpiredNowGiveFalse(): void{
        $verifyToken = new VerifyToken();

        $twoHoursBefore = new DateTime();
        $twoHoursBefore = $twoHoursBefore->format('Y-m-d H:i:s');

        $this->assertSame( $verifyToken->tokenNotExpired($twoHoursBefore), false);
    }


}