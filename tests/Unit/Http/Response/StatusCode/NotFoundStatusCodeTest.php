<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\NotFoundStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\NotFoundStatusCode
 */
class NotFoundStatusCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(404, (new NotFoundStatusCode())->asInt());
    }
}
