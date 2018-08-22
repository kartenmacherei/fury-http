<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\CookieExpiryTime;
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

    private const EXPIRE_IMMEDIATALY = '0';

    protected function setUp()
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeader(): void
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some+value; path=/; secure; HttpOnly',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    public function expiryDateProvider(): array
    {
        return [
            'expiry in the past' => ['2018-03-27 13:57:00', self::EXPIRE_IMMEDIATALY, 'Tue, 27-Mar-2018 13:57:00 GMT'],
            'expiry in the future' => ['2999-03-27 13:57:00', '', 'Wed, 27-Mar-2999 13:57:00 GMT'],
        ];
    }

    /**
     * @dataProvider expiryDateProvider
     * @runInSeparateProcess
     *
     * @param string $dateTimeValue
     * @param string $expectedMaxAgeValue
     * @param string $expectedExpiredValue
     */
    public function testSetsExpectedCookieHeaderWithExpiresAt(
        string $dateTimeValue, string $expectedMaxAgeValue, string $expectedExpiredValue
    ): void {
        $expectedFirstPartOfCookieHeader = sprintf(
            'Set-Cookie: some_cookie=somevalue; expires=%s; Max-Age=',
            $expectedExpiredValue
        );
        $expectedSecondPartOfCookieHeader = '; path=/; secure; HttpOnly';

        $cookie = new ResponseCookie('some_cookie', 'somevalue');
        $cookie->expiresAt(new CookieExpiryTime($dateTimeValue));
        $cookie->send();

        $xdebugHeaders = xdebug_get_headers();
        $this->assertContains(
            $expectedFirstPartOfCookieHeader,
            $xdebugHeaders[0]
        );
        $this->assertContains($expectedSecondPartOfCookieHeader, $xdebugHeaders[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithDomain(): void
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->forDomain('myDomain');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some+value; path=/; domain=myDomain; secure; HttpOnly',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    public function testSetInvalidDomainThrowsException(): void
    {
        $this->expectException(EnsureException::class);
        $this->expectExceptionMessage('empty domain');
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->forDomain('');
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithoutHttpOnly(): void
    {
        $cookie = new ResponseCookie('some_cookie', 'some value');
        $cookie->allowClientAccess();
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some+value; path=/; secure',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }
}
