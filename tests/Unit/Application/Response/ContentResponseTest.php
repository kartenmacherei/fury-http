<?php declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\ContentResponse;
use Fury\Application\JsonContentType;
use Fury\Http\ResponseCookie;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\ContentResponse
 */
class ContentResponseTest extends TestCase
{
    protected function setUp()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('Test requires Xdebug extension');
        }
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedHttpResponseCode()
    {
        $response = new ContentResponse($this->getContentMock());
        ob_start();
        $response->send();
        ob_end_clean();
        $this->assertSame(200, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedContentTypeHeader()
    {
        $content = $this->getContentMock();
        $content->method('getContentType')->willReturn(new JsonContentType());
        $response = new ContentResponse($content);
        ob_start();
        $response->send();
        ob_end_clean();

        $this->assertSame(
            ['Content-Type: application/json; charset=UTF-8'], xdebug_get_headers()
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function testSendsCookies()
    {
        $response = new ContentResponse($this->getContentMock());

        $cookie1 = $this->getResponseCookieMock();
        $cookie1->expects($this->once())->method('send');

        $cookie2 = $this->getResponseCookieMock();
        $cookie2->expects($this->once())->method('send');

        $response->addCookie($cookie1);
        $response->addCookie($cookie2);

        ob_start();
        $response->send();
        ob_end_clean();
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
        return $this->createMock(Content::class);
    }
}
