<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\CookieNotFoundException;
use Fury\Http\Request\RequestCookie;
use Fury\Http\Request\RequestCookieJar;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Request\RequestCookieJar
 */
class RequestCookieJarTest extends TestCase
{
    /**
     * @var RequestCookieJar
     */
    private $jar;

    protected function setUp(): void
    {
        $_COOKIE = ['foo' => 'bar'];
        $this->jar = RequestCookieJar::fromSuperGlobals();
    }

    /**
     * @runInSeparateProcess
     */
    public function testHasCookieReturnsExpectedValue(): void
    {
        $this->assertFalse($this->jar->hasCookie('baz'));
        $this->assertTrue($this->jar->hasCookie('foo'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetCookieReturnsExpectedObject(): void
    {
        $expected = new RequestCookie('foo', 'bar');
        $this->assertEquals($expected, $this->jar->getCookie('foo'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetCookieThrowsExceptionIfCookieDoesNotExist(): void
    {
        $this->expectException(CookieNotFoundException::class);
        $this->jar->getCookie('baz');
    }
}
