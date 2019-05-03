<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\JsonContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\JsonContentType
 */
class JsonContentTypeTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $type = new JsonContentType();
        $this->assertSame('application/json', $type->asString());
    }
}
