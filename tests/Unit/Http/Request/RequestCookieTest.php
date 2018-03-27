<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\RequestCookie;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\RequestCookie
 */
class RequestCookieTest extends TestCase
{
    public function testGetNameReturnsExpectedString()
    {
        $cookie = new RequestCookie('some_cookie', 'some value');
        $this->assertSame('some_cookie', $cookie->getName());
    }

    public function testGetValueReturnsExpectedString()
    {
        $cookie = new RequestCookie('some_cookie', 'some value');
        $this->assertSame('some value', $cookie->getValue());
    }
}
