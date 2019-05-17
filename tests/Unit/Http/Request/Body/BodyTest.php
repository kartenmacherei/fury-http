<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Application\Content\ContentType;
use Fury\Http\Request\Body\Body;
use Fury\Http\Request\Body\JsonBody;
use Fury\Http\Request\Body\RawBody;
use Fury\Http\Request\Body\UnsupportedRequestBodyException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Body
 *
 * @uses \Fury\Http\RawBody
 */
class BodyTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testCreatesRawBodyIfInputStreamAndPostArrayAreEmpty(): void
    {
        $this->assertEquals(new RawBody(''), Body::fromSuperGlobals());
    }

    public function testCreatesRawBodyIfContentTypeWasNotProvided(): void
    {
        $this->assertEquals(
            new RawBody('some content' . "\n"),
            Body::fromSuperGlobals(__DIR__ . '/fixtures/input.txt')
        );
    }

    /**
     * @runInSeparateProcess
     *
     * @dataProvider jsonContentTypeProvider
     *
     * @param string $jsonContentType
     */
    public function testCreatesJsonBody(string $jsonContentType): void
    {
        $_SERVER['CONTENT_TYPE'] = $jsonContentType;
        $this->assertEquals(
            new JsonBody('{"foo":"bar"}' . "\n"),
            Body::fromSuperGlobals(__DIR__ . '/fixtures/input.json')
        );
    }

    public function jsonContentTypeProvider(): array
    {
        return [
            [ContentType::JSON],
            [ContentType::JSON_UTF8],
        ];
    }

    /**
     * @runInSeparateProcess
     */
    public function testThrowsExceptionIfContentTypeIsUnsupported(): void
    {
        $_SERVER['CONTENT_TYPE'] = 'foo';
        $this->expectException(UnsupportedRequestBodyException::class);
        Body::fromSuperGlobals(__DIR__ . '/fixtures/input.txt');
    }
}
