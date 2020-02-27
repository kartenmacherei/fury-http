<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode\NotFoundStatusCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Response\StatusCode\NotFoundStatusCode
 */
class NotFoundStatusCodeTest extends TestCase
{
    public function testReturnsExpectedInt(): void
    {
        $this->assertSame(404, (new NotFoundStatusCode())->asInt());
    }
}
