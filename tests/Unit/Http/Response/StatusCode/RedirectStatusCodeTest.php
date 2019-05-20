<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\UnitTests;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode\RedirectStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Response\StatusCode\RedirectStatusCode
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
