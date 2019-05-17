<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Response\MethodNotAllowedResponse;
use Fury\Http\Request\SupportedRequestMethods;
use Fury\Http\Response\ResponseCookie;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Response\MethodNotAllowedResponse
 */
class MethodNotAllowedResponseTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedHttpResponseCode(): void
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
