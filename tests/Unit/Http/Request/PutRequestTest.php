<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\PutRequest;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookieJar;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\PutRequest
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\Request
 */
class PutRequestTest extends TestCase
{
    /** @var PutRequest */
    private $request;

    protected function setUp(): void
    {
        $this->request = $this->getPutRequest();
    }

    public function testHasParametersReturnsFalse(): void
    {
        $this->assertFalse($this->request->hasParameters());
    }

    public function testHasBodyReturnsFalse(): void
    {
        $this->assertFalse($this->request->hasBody());
    }

    public function testIsPutRequestReturnsTrue(): void
    {
        $this->assertTrue($this->request->isPutRequest());
    }

    public function testIsGetRequestReturnsFalse(): void
    {
        $this->assertFalse($this->request->isGetRequest());
    }

    /**
     * @return MockObject|PutRequest
     */
    private function getPutRequest()
    {
        return $this->getMockForAbstractClass(
            PutRequest::class,
            [[], $this->getUriPathMock(), $this->getRequestCookieJarMock()]
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
