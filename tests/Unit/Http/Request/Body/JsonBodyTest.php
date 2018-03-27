<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\EnsureException;
use Fury\Http\JsonBody;
use Fury\Http\JsonObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\JsonBody
 *
 * @uses \Fury\Http\JsonObject
 */
class JsonBodyTest extends TestCase
{
    public function testThrowsExceptionIfValueCannotBeDecoded()
    {
        $this->expectException(EnsureException::class);
        new JsonBody('foo');
    }

    public function testGetJsonReturnsExpectedJsonObject()
    {
        $jsonString = '{"foo":"bar"}';
        $body = new JsonBody($jsonString);
        $expected = new JsonObject(json_decode($jsonString));

        $this->assertEquals($expected, $body->getJson());
    }

    public function testGetEncodedStringReturnsExpectedString()
    {
        $jsonString = '{"foo":"bar"}';
        $body = new JsonBody($jsonString);

        $this->assertSame($jsonString, $body->getEncodedString());
    }

    public function testQueryReturnsExpectedValue()
    {
        $jsonString = '{"foo":"bar"}';
        $body = new JsonBody($jsonString);
        $this->assertSame('bar', $body->query('foo'));
    }
}
