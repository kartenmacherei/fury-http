<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\EncodeException;
use Kartenmacherei\HttpFramework\Application\Content\JsonContent;
use Kartenmacherei\HttpFramework\Application\Content\JsonContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Content\JsonContent
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Content\EncodeException
 * @uses \Kartenmacherei\HttpFramework\Application\Content\JsonContentType
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
