<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\ContentResponse;
use Fury\Application\ContentType;
use Fury\Http\ResponseCookie;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\ContentResponse
 */
class ContentResponseTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    private const CONTENT_VALUE = 'foo';
    private const CONTENT_TYPE_VALUE = 'application/json';

    protected function setUp()
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedHttpResponseCode()
    {
        $this->expectOutputString(self::CONTENT_VALUE);
        $response = new ContentResponse($this->getContentMock());
        $response->send();
        $this->assertSame(200, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedContentTypeHeader()
    {
        $this->expectOutputString(self::CONTENT_VALUE);
        $content = $this->getContentMock();
        $response = new ContentResponse($content);
        $response->send();

        $this->assertSame(
            ['Content-Type: application/json; charset=UTF-8'], xdebug_get_headers()
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function testSendsCookies()
    {
        $this->expectOutputString(self::CONTENT_VALUE);
        $response = new ContentResponse($this->getContentMock());

        $cookie1 = $this->getResponseCookieMock();
        $cookie1->expects($this->once())->method('send');

        $cookie2 = $this->getResponseCookieMock();
        $cookie2->expects($this->once())->method('send');

        $response->addCookie($cookie1);
        $response->addCookie($cookie2);

        $response->send();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResponseCookie
     */
    private function getResponseCookieMock()
    {
        return $this->createMock(ResponseCookie::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Content
     */
    private function getContentMock()
    {
        $contentMock = $this->createMock(Content::class);
        $contentTypeMock = $this->createMock(ContentType::class);

        $contentMock->expects($this->once())
            ->method('asString')
            ->willReturn(self::CONTENT_VALUE);

        $contentMock->expects($this->once())
            ->method('getContentType')
            ->willReturn($contentTypeMock);

        $contentTypeMock->expects($this->once())
            ->method('asString')
            ->willReturn(self::CONTENT_TYPE_VALUE);

        return $contentMock;
    }
}
