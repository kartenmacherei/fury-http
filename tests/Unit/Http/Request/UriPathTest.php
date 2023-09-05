<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\InvalidUriPathException;
use Kartenmacherei\HttpFramework\Http\Request\Pattern;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\UriPath
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\Pattern
 */
class UriPathTest extends TestCase
{
    public function testThrowsExceptionIfPathDoesNotStartWithASlash(): void
    {
        $this->expectException(InvalidUriPathException::class);
        new UriPath('foo');
    }

    /**
     * @dataProvider startsWithTestDataProvider
     *
     * @param string $pathValue
     * @param string $string
     * @param bool $expectedResult
     */
    public function testStartsWithReturnsExpectedValue(string $pathValue, string $string, bool $expectedResult): void
    {
        $path = new UriPath($pathValue);
        $this->assertSame($expectedResult, $path->startsWith($string));
    }

    public function testAsStringReturnsExpectedString(): void
    {
        $path = new UriPath('/foo/bar');
        $this->assertSame('/foo/bar', $path->asString());
    }

    public function urlWithQueryParameterProvider(): array
    {
        return [
            'with trailing slash' => ['/foo/bar/?ignore=me', '/foo/bar/'],
            'without trailing slash' => ['/foo/bar?ignore=me', '/foo/bar'],
        ];
    }

    /**
     * @dataProvider urlWithQueryParameterProvider
     *
     * @param string $givenUriPath
     * @param string $expected
     */
    public function testUrlQueryParameterAreIgnored($givenUriPath, $expected): void
    {
        $path = new UriPath($givenUriPath);
        $this->assertSame($expected, $path->asString());
    }

    /**
     * @dataProvider asStringWithoutTrailingSlashDataProvider
     *
     * @param string $path
     * @param string $expectedString
     */
    public function testAsStringWithoutTrailingSlash(string $path, string $expectedString): void
    {
        $path = new UriPath($path);
        $this->assertSame($expectedString, $path->asStringWithoutTrailingSlash());
    }

    /**
     * @dataProvider equalsTestDataProvider
     *
     * @param string $path1Value
     * @param string $path2Value
     * @param bool $expectedResult
     */
    public function testEqualsReturnsExpectedValue(string $path1Value, string $path2Value, bool $expectedResult): void
    {
        $path1 = new UriPath($path1Value);
        $path2 = new UriPath($path2Value);

        $this->assertSame($expectedResult, $path1->equals($path2));
    }

    /**
     * @dataProvider matchesTestDataProvider
     *
     * @param string $pathValue
     * @param Pattern $pattern
     * @param bool $expectedResult
     */
    public function testMatchesReturnsExpectedValue(string $pathValue, Pattern $pattern, bool $expectedResult): void
    {
        $path = new UriPath($pathValue);
        $this->assertSame($expectedResult, $path->matches($pattern));
    }

    public function matchesTestDataProvider(): array
    {
        return [
            ['/foo/bar/123', new Pattern('/123$'), true],
            ['/foo/bar/123', new Pattern('baz'), false],
        ];
    }

    public function equalsTestDataProvider(): array
    {
        return [
            ['/foo', '/bar', false],
            ['/foo/bar', '/foo/ba', false],
            ['/foo/bar', '/foo', false],
            ['/foo/bar', '/foo/bar', true],
            ['/foo', '/foo', true],
            ['/foo?ignore=me', '/foo', true],
            ['//', '/', true],
            ['//foo/bar', '/foo/bar', true],
        ];
    }

    public function startsWithTestDataProvider(): array
    {
        return [
           ['/foo', '/fo', true],
           ['/foo', 'fo', false],
           ['/foo', '/bar', false],
        ];
    }

    public function asStringWithoutTrailingSlashDataProvider(): array
    {
        return [
            ['/foo/', '/foo'],
            ['/foo', '/foo'],
        ];
    }
}
