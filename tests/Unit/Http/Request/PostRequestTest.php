<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\PostRequest;
use Fury\Http\RequestCookieJar;
use Fury\Http\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\PostRequest
 *
 * @uses \Fury\Http\Request
 */
class PostRequestTest extends TestCase
{
    /**
     * @var PostRequest
     */
    private $request;

    protected function setUp()
    {
        $this->request = $this->getPostRequest();
    }

    public function testHasParametersReturnsFalse()
    {
        $this->assertFalse($this->request->hasParameters());
    }

    public function testHasBodyReturnsFalse()
    {
        $this->assertFalse($this->request->hasBody());
    }

    public function testIsPostRequestReturnsTrue()
    {
        $this->assertTrue($this->request->isPostRequest());
    }

    public function testIsGetRequestReturnsFalse()
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
