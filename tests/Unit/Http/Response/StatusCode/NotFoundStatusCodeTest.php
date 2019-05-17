<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Response\StatusCode\NotFoundStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Response\StatusCode\NotFoundStatusCode
 */
class NotFoundStatusCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(404, (new NotFoundStatusCode())->asInt());
    }
}
