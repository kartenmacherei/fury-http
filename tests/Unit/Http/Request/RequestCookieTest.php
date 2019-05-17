<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Request\RequestCookie;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Request\RequestCookie
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
