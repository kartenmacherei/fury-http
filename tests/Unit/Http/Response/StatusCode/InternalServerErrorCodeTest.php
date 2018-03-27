<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\InternalServerErrorCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\InternalServerErrorCode
 */
class InternalServerErrorCodeTest extends TestCase
{
    public function testReturnsExpectedInt()
    {
        $this->assertSame(500, (new InternalServerErrorCode())->asInt());
    }
}
