<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\RawBody;
use Fury\Http\RawPostRequest;
use Fury\Http\RequestCookieJar;
use Fury\Http\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\RawPostRequest
 *
 * @uses \Fury\Http\Request
 */
class RawPostRequestTest extends TestCase
{
    /**
     * @var RawPostRequest
     */
    private $request;

    /**
     * @var RawBody|MockObject
     */
    private $body;

    protected function setUp()
    {
        $this->body = $this->getRawBodyMock();

        $this->request = new RawPostRequest(
            $this->getUriPathMock(),
            $this->getRequestCookieJarMock(),
            $this->body
        );
    }

    public function testHasBodyReturnsTrue()
    {
        $this->assertTrue($this->request->hasBody());
    }

    public function testGetBodyReturnsExpectedString()
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
