<?php declare(strict_types=1);
require __DIR__.'/../autoloader.php';

use PHPUnit\Framework\TestCase;
use app\config\DatabaseConnector;

final class DatabaseTest extends TestCase
{
    public function testExample(): void
    {
        $db = new DatabaseConnector();
        $this->assertSame('foo', 'foo');
    }
}