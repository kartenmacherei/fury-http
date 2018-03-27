<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\JsonBody;
use Fury\Http\JsonPostRequest;
use Fury\Http\RequestCookieJar;
use Fury\Http\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\JsonPostRequest
 * @uses \Fury\Http\Request
 */
class JsonPostRequestTest extends TestCase
{
    /**
     * @var JsonPostRequest
     */
    private $request;

    /**
     * @var JsonBody|MockObject
     */
    private $body;

    protected function setUp()
    {
        $this->body = $this->getJsonBodyMock();

        $this->request = new JsonPostRequest(
            $this->getUriPathMock(),
            $this->getRequestCookieJarMock(),
            $this->body
        );
    }

    public function testHasBodyReturnsTrue()
    {
        $this->assertTrue($this->request->hasBody());
    }

    public function testGetBodyReturnsExpectedBody()
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
