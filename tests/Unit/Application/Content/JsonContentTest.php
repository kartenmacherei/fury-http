<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\EncodeException;
use Fury\Application\JsonContent;
use Fury\Application\JsonContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\JsonContent
 *
 * @uses \Fury\Application\EncodeException
 * @uses \Fury\Application\JsonContentType
 */
class JsonContentTest extends TestCase
{
    /**
     * @dataProvider unencodableTestDataProvider
     *
     * @param mixed $value
     */
    public function testThrowsExceptionIfValueCannotBeEncodedToJson($value)
    {
        $this->expectException(EncodeException::class);
        new JsonContent($value);
    }

    public function testGetContentTypeReturnsExpectedContentType()
    {
        $content = new JsonContent('foo');
        $this->assertEquals(new JsonContentType(), $content->getContentType());
    }

    public function testAsStringReturnsExpectedEncodedJsonString()
    {
        $content = new JsonContent(['foo' => 'bar']);
        $this->assertSame('{"foo":"bar"}', $content->asString());
    }

    public function unencodableTestDataProvider()
    {
        return [
            [fopen('php://memory', 'r')],
        ];
    }
}
