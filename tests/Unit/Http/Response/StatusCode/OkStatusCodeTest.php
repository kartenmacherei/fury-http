<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Response\StatusCode\OkStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\OkStatusCode
 */
class OkStatusCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(200, (new OkStatusCode())->asInt());
    }
}
