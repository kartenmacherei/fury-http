<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Response\StatusCode\RedirectStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\RedirectStatusCode
 */
class RedirectStatusCodeTest extends TestCase
{
    public function testAsIntReturnExpectedValue(): void
    {
        $expectedStatusCode = 302;

        $statusCode = new RedirectStatusCode();
        $this->assertSame($expectedStatusCode, $statusCode->asInt());
    }
}
