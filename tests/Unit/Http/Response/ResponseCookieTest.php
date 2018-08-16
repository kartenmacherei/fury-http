<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\EnsureException;
use Fury\Http\ResponseCookie;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\ResponseCookie
 */
class ResponseCookieTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    protected function setUp()
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeader()
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some%20value; Path=/; Secure; HttpOnly',
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
            'Set-Cookie: some_cookie=some%20value; Path=/; Secure; HttpOnly; Expires=Tuesday, 27-Mar-2018 13:57:00 UTC',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithDomain()
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->forDomain('myDomain');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some%20value; Path=/; Secure; Domain=myDomain; HttpOnly',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    public function testSetInvalidDomainThrowsException()
    {
        $this->expectException(EnsureException::class);
        $this->expectExceptionMessage('empty domain');
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->forDomain('');
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
            'Set-Cookie: some_cookie=some%20value; Path=/; Secure',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }
}
