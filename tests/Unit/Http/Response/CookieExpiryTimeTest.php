<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Response\CookieExpiryTime;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Response\CookieExpiryTime
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
