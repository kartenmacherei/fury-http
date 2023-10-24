<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode\InternalServerErrorCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Response\StatusCode\InternalServerErrorCode
 */
class InternalServerErrorCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(500, (new InternalServerErrorCode())->asInt());
    }
}
