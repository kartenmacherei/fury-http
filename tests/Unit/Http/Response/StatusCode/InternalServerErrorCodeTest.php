<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Response\StatusCode\InternalServerErrorCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Response\StatusCode\InternalServerErrorCode
 */
class InternalServerErrorCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(500, (new InternalServerErrorCode())->asInt());
    }
}
