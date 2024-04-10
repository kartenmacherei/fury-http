<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\EnsureException;
use Kartenmacherei\HttpFramework\Http\JsonArray;
use Kartenmacherei\HttpFramework\Http\JsonObject;
use Kartenmacherei\HttpFramework\Http\Request\Body\JsonBody;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\Body\JsonBody
 *
 * @uses \Kartenmacherei\HttpFramework\Http\JsonObject
 * @uses \Kartenmacherei\HttpFramework\Http\JsonArray
 */
class JsonBodyTest extends TestCase
{
    public function testThrowsExceptionIfValueCannotBeDecoded(): void
    {
        $this->expectException(EnsureException::class);
        new JsonBody('foo');
    }

    public function testGetJsonReturnsExpectedJsonObject(): void
    {
        $jsonString = '{"foo":"bar"}';
        $body = new JsonBody($jsonString);
        $expected = new JsonObject(json_decode($jsonString));

        $this->assertEquals($expected, $body->getJson());
    }

    public function testGetEncodedStringReturnsExpectedString(): void
    {
        $jsonString = '{"foo":"bar"}';
        $body = new JsonBody($jsonString);

        $this->assertSame($jsonString, $body->getEncodedString());
    }

    public function testQueryReturnsExpectedValue(): void
    {
        $jsonString = '{"foo":"bar"}';
        $body = new JsonBody($jsonString);
        $this->assertSame('bar', $body->query('foo'));
    }

    public function testGetJsonReturnsJsonArrayForArrayStrings(): void
    {
        $jsonString = '["foo","bar"]';
        $body = new JsonBody($jsonString);
        $expected = new JsonArray(json_decode($jsonString));

        $this->assertEquals($expected, $body->getJson());
    }
}
