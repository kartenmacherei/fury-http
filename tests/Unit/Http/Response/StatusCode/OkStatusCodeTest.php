<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\OkStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\OkStatusCode
 */
class OkStatusCodeTest extends TestCase
{
    public function testReturnsExpectedInt()
    {
        $this->assertSame(200, (new OkStatusCode())->asInt());
    }
}
