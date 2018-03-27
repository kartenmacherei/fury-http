<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\RawBody;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\RawBody
 */
class RawBodyTest extends TestCase
{
    public function testReturnsExpectedString()
    {
        $body = new RawBody('some content');
        $this->assertSame('some content', $body->getContent());
    }
}
