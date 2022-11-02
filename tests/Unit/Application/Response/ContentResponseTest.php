<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Application\Content\ContentType;
use Kartenmacherei\HttpFramework\Application\Response\ContentResponse;
use Kartenmacherei\HttpFramework\Http\Response\ResponseCookie;
use Kartenmacherei\HttpFramework\UnitTest\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Response\ContentResponse
 */
class ContentResponseTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    private const CONTENT_VALUE = 'foo';
    private const CONTENT_TYPE_VALUE = 'application/json';

    protected function setUp(): void
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedHttpResponseCode(): void
    {
        $this->expectOutputString(self::CONTENT_VALUE);
        $response = new ContentResponse($this->getContentMock());
        $response->send();
        $this->assertSame(200, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedContentTypeHeader(): void
    {
        $this->expectOutputString(self::CONTENT_VALUE);
        $content = $this->getContentMock();
        $response = new ContentResponse($content);
        $response->send();

        $this->assertSame(
            ['Content-Type: application/json; charset=UTF-8'],
            xdebug_get_headers()
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function testSendsCookies(): void
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
     * @return MockObject|ResponseCookie
     */
    private function getResponseCookieMock()
    {
        return $this->createMock(ResponseCookie::class);
    }

    /**
     * @return MockObject|Content
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
