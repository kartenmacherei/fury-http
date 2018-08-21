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

    public function expiryDateProvider(): array
    {
        return [
            'expiry in the past' => ['2018-03-27 13:57:00', '-', 'Tuesday, 27-Mar-2018 13:57:00 UTC'],
            'expiry in the future' => ['2999-03-27 13:57:00', '', 'Wednesday, 27-Mar-2999 13:57:00 UTC'],
        ];
    }

    /**
     * @dataProvider expiryDateProvider
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithExpiresAt(
        string $dateTimeValue, string $expectedAlgebraicSign, string $expectedExpiredString
    ) {
        $cookie = new ResponseCookie('some_cookie', 'somevalue');
        $cookie->expiresAt(new \DateTimeImmutable($dateTimeValue));
        $cookie->send();

        $expected = [
            sprintf(
                'Set-Cookie: some_cookie=somevalue; Path=/; Secure; HttpOnly; Expires=%s; Max-Age=%s',
                $expectedExpiredString,
                $expectedAlgebraicSign
            ),
        ];

        $xdebugHeaders = xdebug_get_headers();
        $this->assertContains($expected[0], $xdebugHeaders[0]);
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
