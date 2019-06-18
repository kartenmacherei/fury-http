<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\UnitTests;

use Kartenmacherei\HttpFramework\Http\EnsureException;
use Kartenmacherei\HttpFramework\Http\Exception;
use Kartenmacherei\HttpFramework\Http\Response\CookieExpiryTime;
use Kartenmacherei\HttpFramework\Http\Response\DeletionResponseCookie;
use Kartenmacherei\HttpFramework\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Response\ResponseCookie
 * @covers \Kartenmacherei\HttpFramework\Http\Response\DeletionResponseCookie
 */
class DeletionResponseCookieTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    protected function setUp(): void
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeader(): void
    {
        $cookie = new DeletionResponseCookie('some_cookie');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=deleted; expires=Thu, 01-Jan-1970 00:00:01 GMT; Max-Age=0; path=/; secure; HttpOnly',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSettingExpiryDateThrowsAnException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('not allowed');
        $cookie = new DeletionResponseCookie('some_cookie');
        $cookie->expiresAt(new CookieExpiryTime('2999-03-27 13:57:00'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithDomain(): void
    {
        $cookie = new DeletionResponseCookie('some_cookie');
        $cookie->forDomain('myDomain');
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=deleted; expires=Thu, 01-Jan-1970 00:00:01 GMT; Max-Age=0; path=/; domain=myDomain; secure; HttpOnly',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }

    /**
     * @uses \Kartenmacherei\HttpFramework\Http\Response\CookieExpiryTime
     */
    public function testSetInvalidDomainThrowsException(): void
    {
        $this->expectException(EnsureException::class);
        $this->expectExceptionMessage('empty domain');
        $cookie = new DeletionResponseCookie('some_cookie');
        $cookie->forDomain('');
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedCookieHeaderWithoutHttpOnly(): void
    {
        $cookie = new DeletionResponseCookie('some_cookie');
        $cookie->allowClientAccess();
        $cookie->send();

        $expected = [
            'Set-Cookie: some_cookie=deleted; expires=Thu, 01-Jan-1970 00:00:01 GMT; Max-Age=0; path=/; secure',
        ];

        $this->assertSame($expected, xdebug_get_headers());
    }
}
