<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function testExample(): void
    {
        $foo = 'foo';
        $this->assertSame('foo', $foo);
    }
}