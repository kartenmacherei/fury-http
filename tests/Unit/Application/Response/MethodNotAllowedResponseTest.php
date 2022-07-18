<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Response\MethodNotAllowedResponse;
use Kartenmacherei\HttpFramework\Http\Request\SupportedRequestMethods;
use Kartenmacherei\HttpFramework\Http\Response\ResponseCookie;
use Kartenmacherei\HttpFramework\UnitTest\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Response\MethodNotAllowedResponse
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
        $this->assertStringContainsString(
            sprintf('Allow: HEAD, GET, POST'),
            $headers[0]
        );
    }
}
