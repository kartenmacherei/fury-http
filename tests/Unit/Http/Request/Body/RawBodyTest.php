<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Request\Body\RawBody;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\RawBody
 */
class RawBodyTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $body = new RawBody('some content');
        $this->assertSame('some content', $body->getContent());
    }
}
