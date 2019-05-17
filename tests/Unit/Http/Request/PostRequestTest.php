<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Request\PostRequest;
use Fury\Http\Request\RequestCookieJar;
use Fury\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Request\PostRequest
 *
 * @uses \Fury\Http\Request\Request
 */
class PostRequestTest extends TestCase
{
    /**
     * @var PostRequest
     */
    private $request;

    protected function setUp(): void
    {
        $this->request = $this->getPostRequest();
    }

    public function testHasParametersReturnsFalse(): void
    {
        $this->assertFalse($this->request->hasParameters());
    }

    public function testHasBodyReturnsFalse(): void
    {
        $this->assertFalse($this->request->hasBody());
    }

    public function testIsPostRequestReturnsTrue(): void
    {
        $this->assertTrue($this->request->isPostRequest());
    }

    public function testIsGetRequestReturnsFalse(): void
    {
        $this->assertFalse($this->request->isGetRequest());
    }

    /**
     * @return MockObject|PostRequest
     */
    private function getPostRequest()
    {
        return $this->getMockForAbstractClass(
            PostRequest::class, [$this->getUriPathMock(), $this->getRequestCookieJarMock()]
        );
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
