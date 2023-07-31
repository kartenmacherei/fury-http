<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\Body\RawBody;
use Kartenmacherei\HttpFramework\Http\Request\RawPutRequest;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookieJar;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\RawPutRequest
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\Request
 */
class RawPutRequestTest extends TestCase
{
    /** @var RawPutRequest */
    private $request;

    /** @var RawBody|MockObject */
    private $body;

    protected function setUp(): void
    {
        $this->body = $this->getRawBodyMock();

        $this->request = new RawPutRequest(
            $this->getUriPathMock(),
            $this->getRequestCookieJarMock(),
            $this->body,
            []
        );
    }

    public function testHasBodyReturnsTrue(): void
    {
        $this->assertTrue($this->request->hasBody());
    }

    public function testGetBodyReturnsExpectedString(): void
    {
        $this->body->method('getContent')->willReturn('some content');
        $this->assertSame('some content', $this->request->getBody());
    }

    /**
     * @return MockObject|RawBody
     */
    private function getRawBodyMock()
    {
        return $this->createMock(RawBody::class);
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
