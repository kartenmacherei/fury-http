<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Url;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Url
 */
class UrlTest extends TestCase
{
    public function testReturnsExpectedString()
    {
        $url = new Url('https://example.com/foo');
        $this->assertSame('https://example.com/foo', $url->asString());
    }
}
