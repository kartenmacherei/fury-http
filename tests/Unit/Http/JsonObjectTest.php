<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\JsonArray;
use Fury\Http\JsonException;
use Fury\Http\JsonObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\JsonObject
 *
 * @uses \Fury\Http\JsonArray
 */
class JsonObjectTest extends TestCase
{
    public function testHasReturnsExpectedValue(): void
    {
        $object = new \stdClass();
        $object->foo = true;

        $jsonObject = new JsonObject($object);

        $this->assertFalse($jsonObject->has('bar'));
        $this->assertTrue($jsonObject->has('foo'));
    }

    public function testQueryThrowsExceptionIfPropertyIsNotSet(): void
    {
        $jsonObject = new JsonObject(new \stdClass());
        $this->expectException(JsonException::class);

        $jsonObject->query('foo');
    }

    /**
     * @dataProvider queryTestDataProvider
     *
     * @param mixed $value
     * @param mixed $expectedValue
     */
    public function testQueryReturnsExpectedValue($value, $expectedValue): void
    {
        $object = new \stdClass();
        $object->foo = $value;

        $jsonObject = new JsonObject($object);
        $this->assertEquals($expectedValue, $jsonObject->query('foo'));
    }

    public function queryTestDataProvider()
    {
        return [
            ['bar', 'bar'],
            [['foobar' => 'baz'], new JsonArray(['foobar' => 'baz'])],
            [new \stdClass(), new JsonObject(new \stdClass())],
        ];
    }
}
