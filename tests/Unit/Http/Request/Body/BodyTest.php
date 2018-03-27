<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Application\ContentType;
use Fury\Http\Body;
use Fury\Http\JsonBody;
use Fury\Http\RawBody;
use Fury\Http\UnsupportedRequestBodyException;
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
    public function testCreatesRawBodyIfInputStreamAndPostArrayAreEmpty()
    {
        $this->assertEquals(new RawBody(''), Body::fromSuperGlobals());
    }

    public function testCreatesRawBodyIfContentTypeWasNotProvided()
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
    public function testCreatesJsonBody(string $jsonContentType)
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
    public function testThrowsExceptionIfContentTypeIsUnsupported()
    {
        $_SERVER['CONTENT_TYPE'] = 'foo';
        $this->expectException(UnsupportedRequestBodyException::class);
        Body::fromSuperGlobals(__DIR__ . '/fixtures/input.txt');
    }
}
