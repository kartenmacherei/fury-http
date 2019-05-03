<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\MethodNotAllowedCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\MethodNotAllowedCode
 */
class MethodNotAllowedCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(405, (new MethodNotAllowedCode())->asInt());
    }
}
