<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\BaseResponse;
use Fury\Http\ResponseCookie;
use Fury\Http\StatusCode;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\BaseResponse
 */
class BaseResponseTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSendSetsExpectedHttpResponseCode(): void
    {
        $statusCode = $this->getStatusCodeMock();
        $statusCode->method('asInt')->willReturn(301);

        $response = $this->getBaseResponse();
        $response->method('getStatusCode')->willReturn($statusCode);

        $response->send();

        $this->assertSame(301, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSendCallsFlushMethod(): void
    {
        $statusCode = $this->getStatusCodeMock();
        $statusCode->method('asInt')->willReturn(301);

        $response = $this->getBaseResponse();
        $response->method('getStatusCode')->willReturn($statusCode);

        $response->expects($this->once())->method('flush');
        $response->send();
    }

    /**
     * @runInSeparateProcess
     */
    public function testSendsCookies(): void
    {
        $response = $this->getBaseResponse();

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
     * @return MockObject|StatusCode
     */
    private function getStatusCodeMock()
    {
        return $this->createMock(StatusCode::class);
    }

    /**
     * @return MockObject|BaseResponse
     */
    private function getBaseResponse()
    {
        return $this->getMockForAbstractClass(BaseResponse::class);
    }
}
