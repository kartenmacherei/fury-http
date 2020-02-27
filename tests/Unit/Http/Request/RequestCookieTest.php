<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Http;

use Kartenmacherei\HttpFramework\Http\Request\RequestCookie;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\RequestCookie
 */
class RequestCookieTest extends TestCase
{
    public function testGetNameReturnsExpectedString(): void
    {
        $cookie = new RequestCookie('some_cookie', 'some value');
        $this->assertSame('some_cookie', $cookie->getName());
    }

    public function testGetValueReturnsExpectedString(): void
    {
        $cookie = new RequestCookie('some_cookie', 'some value');
        $this->assertSame('some value', $cookie->getValue());
    }
}
