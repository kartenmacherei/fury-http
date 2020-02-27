<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Http;

use Kartenmacherei\HttpFramework\Http\Response\CookieExpiryTime;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Response\CookieExpiryTime
 */
class CookieExpiryTimeTest extends TestCase
{
    public function testCorrectPropertiesForCookies(): void
    {
        $cookieExpiryTime = new CookieExpiryTime('2018-08-21');
        $this->assertEquals('UTC', $cookieExpiryTime->getTimezone()->getName());
        $this->assertEquals(1534809600, $cookieExpiryTime->getTimestamp());
    }
}
