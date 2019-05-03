<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\JsonArray;
use Fury\Http\JsonObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\JsonArray
 *
 * @uses \Fury\Http\JsonObject
 */
class JsonArrayTest extends TestCase
{
    public function testIsIterable(): void
    {
        $object = new \stdClass();
        $object->foobar = 'baz';

        $array = ['foo' => 'bar'];

        $jsonArray = new JsonArray([$object, $array, 'foo']);

        foreach ($jsonArray as $index => $item) {
            switch ($index) {
                case 0:
                    $expected = new JsonObject($object);
                    $this->assertEquals($expected, $item);
                    break;
                case 1:
                    $expected = new JsonArray($array);
                    $this->assertEquals($expected, $item);
                    break;
                case 2:
                    $this->assertSame('foo', $item);
                    break;
                default:
                    throw new \Exception('Unexpected index');
            }
        }
    }
}
