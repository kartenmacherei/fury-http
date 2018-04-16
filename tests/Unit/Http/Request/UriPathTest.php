<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\InvalidUriPathException;
use Fury\Http\Pattern;
use Fury\Http\UriPath;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\UriPath
 *
 * @uses \Fury\Http\Pattern
 */
class UriPathTest extends TestCase
{
    public function testThrowsExceptionIfPathDoesNotStartWithASlash()
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
    public function testStartsWithReturnsExpectedValue(string $pathValue, string $string, bool $expectedResult)
    {
        $path = new UriPath($pathValue);
        $this->assertSame($expectedResult, $path->startsWith($string));
    }

    public function testAsStringReturnsExpectedString()
    {
        $path = new UriPath('/foo/bar');
        $this->assertSame('/foo/bar', $path->asString());
    }

    /**
     * @dataProvider asStringWithoutTrailingSlashDataProvider
     *
     * @param string $path
     * @param string $expectedString
     */
    public function testAsStringWithoutTrailingSlash(string $path, string $expectedString)
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
    public function testEqualsReturnsExpectedValue(string $path1Value, string $path2Value, bool $expectedResult)
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
    public function testMatchesReturnsExpectedValue(string $pathValue, Pattern $pattern, bool $expectedResult)
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
