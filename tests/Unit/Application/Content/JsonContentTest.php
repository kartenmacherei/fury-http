<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content\EncodeException;
use Fury\Application\Content\JsonContent;
use Fury\Application\Content\JsonContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Content\JsonContent
 *
 * @uses \Fury\Application\Content\EncodeException
 * @uses \Fury\Application\Content\JsonContentType
 */
class JsonContentTest extends TestCase
{
    /**
     * @dataProvider unencodableTestDataProvider
     *
     * @param mixed $value
     */
    public function testThrowsExceptionIfValueCannotBeEncodedToJson($value): void
    {
        $this->expectException(EncodeException::class);
        new JsonContent($value);
    }

    public function testGetContentTypeReturnsExpectedContentType(): void
    {
        $content = new JsonContent('foo');
        $this->assertEquals(new JsonContentType(), $content->getContentType());
    }

    public function testAsStringReturnsExpectedEncodedJsonString(): void
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
