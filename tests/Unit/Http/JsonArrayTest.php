<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Exception;
use Kartenmacherei\HttpFramework\Http\JsonArray;
use Kartenmacherei\HttpFramework\Http\JsonObject;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\JsonArray
 *
 * @uses \Kartenmacherei\HttpFramework\Http\JsonObject
 */
class JsonArrayTest extends TestCase
{
    public function testIsIterable(): void
    {
        $object = new stdClass();
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
                    throw new Exception('Unexpected index');
            }
        }
    }
}
