<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode\ConflictStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Response\StatusCode\ConflictStatusCode
 */
class ConflictStatusCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(409, (new ConflictStatusCode())->asInt());
    }
}
