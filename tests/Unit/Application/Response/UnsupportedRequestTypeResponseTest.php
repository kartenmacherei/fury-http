<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\UnsupportedRequestTypeResponse;
use Fury\Http\ResponseCookie;
use Fury\Http\SupportedRequestMethods;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\UnsupportedRequestTypeResponse
 */
class UnsupportedRequestTypeResponseTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedHttpResponseCode()
    {
        if (!function_exists('xdebug_get_headers')) {
            $this->markTestSkipped('This test requires xdebug_get_headers() from the XDEBUG-Extension.');
        }

        $supportedRequestMethodsMock = $this->createMock(SupportedRequestMethods::class);
        $supportedRequestMethodsMock->expects($this->once())
            ->method('asString')
            ->willReturn('HEAD, GET, POST');

        $response = new UnsupportedRequestTypeResponse($supportedRequestMethodsMock);
        $responseCookie = $this->createMock(ResponseCookie::class);
        $responseCookie->expects($this->once())
            ->method('send');

        $response->addCookie($responseCookie);
        $response->send();

        $this->assertSame(405, http_response_code());

        $headers = xdebug_get_headers();
        $this->assertContains(
            sprintf('Allow: HEAD, GET, POST'),
            $headers[0]
        );
    }
}
