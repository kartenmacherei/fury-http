<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Response\StatusCode\MethodNotAllowedCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Response\StatusCode\MethodNotAllowedCode
 */
class MethodNotAllowedCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(405, (new MethodNotAllowedCode())->asInt());
    }
}
