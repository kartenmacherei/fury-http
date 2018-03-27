<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\ResponseCookie;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\ResponseCookie
 */
class ResponseCookieTest extends TestCase
{
    protected function setUp()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('Test requires Xdebug extension');
        }
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeader()
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some%20value; Path=/; Secure; HttpOnly'
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithExpiresAt()
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->expiresAt(new \DateTimeImmutable('2018-03-27 13:57:00'));
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some%20value; Path=/; Secure; HttpOnly; Expires=Tuesday, 27-Mar-2018 13:57:00 UTC'
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithoutHttpOnly()
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->allowClientAccess();
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some%20value; Path=/; Secure'
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }
}
