<?php declare(strict_types=1);
require __DIR__.'/../autoloader.php';

use PHPUnit\Framework\TestCase;
use app\config\DatabaseConnector;

final class ExampleTest extends TestCase
{
    public function testExample(): void
    {
        $db = new DatabaseConnector();
        $foo = 'foo';
        $this->assertSame('foo', $foo);
    }
}