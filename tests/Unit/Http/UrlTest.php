<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Url;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Url
 */
class UrlTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $url = new Url('https://example.com/foo');
        $this->assertSame('https://example.com/foo', $url->asString());
    }
}
