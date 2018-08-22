<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\CookieExpiryTime;
use Fury\Http\DeletionResponseCookie;
use Fury\Http\EnsureException;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\DeletionResponseCookie
 */
class DeletionResponseCookieTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    private const EXPIRE_IMMEDIATALY = '0';

    private const PREG_MATCH_SUCCESS = 1;

    protected function setUp()
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeader(): void
    {
        $cookie = new DeletionResponseCookie('some_cookie', 'some value');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some+value; path=/; secure; HttpOnly',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithExpiryTimeInTheFuture(): void
    {
        $dateTimeValue = '2999-03-27 13:57:00';
        $expectedExpiredValue = 'Wed, 27-Mar-2999 13:57:00 GMT';

        $expectedFirstPartOfCookieHeader = sprintf(
            'Set-Cookie: some_cookie=somevalue; expires=%s; Max-Age=',
            $expectedExpiredValue
        );
        $expectedSecondPartOfCookieHeader = '; path=/; secure; HttpOnly';

        $cookie = new DeletionResponseCookie('some_cookie', 'somevalue');
        $cookie->expiresAt(new CookieExpiryTime($dateTimeValue));
        $cookie->send();

        $xdebugHeaders = xdebug_get_headers();
        $this->assertContains(
            $expectedFirstPartOfCookieHeader,
            $xdebugHeaders[0]
        );
        $this->assertContains($expectedSecondPartOfCookieHeader, $xdebugHeaders[0]);

        $matches = [];
        $result = preg_match('/Max-Age=(\d*);/', $xdebugHeaders[0], $matches);
        $this->assertEquals(self::PREG_MATCH_SUCCESS, $result);
        $this->assertGreaterThan((int) self::EXPIRE_IMMEDIATALY, (int) $matches[1]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithExpiryTimeInThePast(): void {
        $dateTimeValue = '2018-03-27 13:57:00';
        $expectedExpiredValue = 'Tue, 27-Mar-2018 13:57:00 GMT';

        $cookie = new DeletionResponseCookie('some_cookie', 'somevalue');
        $cookie->expiresAt(new CookieExpiryTime($dateTimeValue));
        $cookie->send();

        $xdebugHeaders = xdebug_get_headers();
        $this->assertEquals(
            sprintf(
                'Set-Cookie: some_cookie=somevalue; expires=%s; Max-Age=%s; path=/; secure; HttpOnly',
                $expectedExpiredValue, self::EXPIRE_IMMEDIATALY
            ),
            $xdebugHeaders[0]
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithDomain(): void
    {
        $cookie = new DeletionResponseCookie('some_cookie', 'some value');
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
        $cookie = new DeletionResponseCookie('some_cookie', 'some value');
        $cookie->forDomain('');
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithoutHttpOnly(): void
    {
        $cookie = new DeletionResponseCookie('some_cookie', 'some value');
        $cookie->allowClientAccess();
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=some+value; path=/; secure',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }
}
