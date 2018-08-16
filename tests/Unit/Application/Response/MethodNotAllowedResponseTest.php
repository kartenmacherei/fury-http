<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\MethodNotAllowedResponse;
use Fury\Http\ResponseCookie;
use Fury\Http\SupportedRequestMethods;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\MethodNotAllowedResponse
 */
class MethodNotAllowedResponseTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedHttpResponseCode()
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();

        $supportedRequestMethodsMock = $this->createMock(SupportedRequestMethods::class);
        $supportedRequestMethodsMock->expects($this->once())
            ->method('asString')
            ->willReturn('HEAD, GET, POST');

        $response = new MethodNotAllowedResponse($supportedRequestMethodsMock);
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
