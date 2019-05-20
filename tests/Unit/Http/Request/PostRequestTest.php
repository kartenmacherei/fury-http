<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\UnitTests;

use Kartenmacherei\HttpFramework\Http\Request\PostRequest;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookieJar;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\PostRequest
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\Request
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
