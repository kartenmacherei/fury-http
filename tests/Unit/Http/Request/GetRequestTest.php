<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\GetRequest;
use Fury\Http\RequestCookieJar;
use Fury\Http\RequestParameterNotFoundException;
use Fury\Http\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\GetRequest
 *
 * @uses \Fury\Http\Request
 */
class GetRequestTest extends TestCase
{
    /**
     * @var GetRequest
     */
    private $request;

    protected function setUp(): void
    {
        $this->request = new GetRequest(
            $this->getUriPathMock(),
            $this->getRequestCookieJarMock(),
            ['foo' => 'bar']
        );
    }

    public function testHasParametersReturnsFalseIfParametersAreEmpty(): void
    {
        $request = new GetRequest(
            $this->getUriPathMock(),
            $this->getRequestCookieJarMock(),
            []
        );

        $this->assertFalse($request->hasParameters());
    }

    public function testHasParametersReturnsTrueIfParametersAreNotEmpty(): void
    {
        $this->assertTrue($this->request->hasParameters());
    }

    public function testHasParameterReturnsExpectedValue(): void
    {
        $this->assertTrue($this->request->hasParameter('foo'));
        $this->assertFalse($this->request->hasParameter('baz'));
    }

    public function testGetParameterThrowsExceptionIfParameterIsNotPresent(): void
    {
        $this->expectException(RequestParameterNotFoundException::class);
        $this->request->getParameter('baz');
    }

    public function testGetParameterReturnsExpectedValue(): void
    {
        $this->assertSame('bar', $this->request->getParameter('foo'));
    }

    public function testIsGetRequestReturnsTrue(): void
    {
        $this->assertTrue($this->request->isGetRequest());
    }

    public function testIsPostRequestReturnsTrue(): void
    {
        $this->assertFalse($this->request->isPostRequest());
    }

    /**
     * @return MockObject|RequestCookieJar
     */
    private function getRequestCookieJarMock()
    {
        return $this->createMock(RequestCookieJar::class);
    }

    /**
     * @return MockObject|UriPath
     */
    private function getUriPathMock()
    {
        return $this->createMock(UriPath::class);
    }
}
