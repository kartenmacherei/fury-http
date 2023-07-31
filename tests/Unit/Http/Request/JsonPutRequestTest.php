<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\Body\JsonBody;
use Kartenmacherei\HttpFramework\Http\Request\JsonPutRequest;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookieJar;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\JsonPutRequest
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\Request
 */
class JsonPutRequestTest extends TestCase
{
    /** @var JsonPutRequest */
    private $request;

    /** @var JsonBody|MockObject */
    private $body;

    protected function setUp(): void
    {
        $this->body = $this->getJsonBodyMock();

        $this->request = new JsonPutRequest(
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

    public function testGetBodyReturnsExpectedBody(): void
    {
        $this->assertSame($this->body, $this->request->getBody());
    }

    /**
     * @return MockObject|JsonBody
     */
    private function getJsonBodyMock()
    {
        return $this->createMock(JsonBody::class);
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
