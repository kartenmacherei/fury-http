<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\CookieNotFoundException;
use Fury\Http\RequestCookie;
use Fury\Http\RequestCookieJar;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\RequestCookieJar
 */
class RequestCookieJarTest extends TestCase
{
    /**
     * @var RequestCookieJar
     */
    private $jar;

    protected function setUp()
    {
        $_COOKIE = ['foo' => 'bar'];
        $this->jar = RequestCookieJar::fromSuperGlobals();
    }

    /**
     * @runInSeparateProcess
     */
    public function testHasCookieReturnsExpectedValue()
    {
        $this->assertFalse($this->jar->hasCookie('baz'));
        $this->assertTrue($this->jar->hasCookie('foo'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetCookieReturnsExpectedObject()
    {
        $expected = new RequestCookie('foo', 'bar');
        $this->assertEquals($expected, $this->jar->getCookie('foo'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetCookieThrowsExceptionIfCookieDoesNotExist()
    {
        $this->expectException(CookieNotFoundException::class);
        $this->jar->getCookie('baz');
    }
}
