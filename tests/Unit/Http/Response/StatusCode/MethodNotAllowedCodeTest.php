<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\UnitTests;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode\MethodNotAllowedCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Response\StatusCode\MethodNotAllowedCode
 */
class MethodNotAllowedCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(405, (new MethodNotAllowedCode())->asInt());
    }
}
