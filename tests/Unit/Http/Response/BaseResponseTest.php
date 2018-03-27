<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\BaseResponse;
use Fury\Http\StatusCode;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BaseResponseTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSendSetsExpectedHttpResponseCode()
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
    public function testSendCallsFlushMethod()
    {
        $statusCode = $this->getStatusCodeMock();
        $statusCode->method('asInt')->willReturn(301);

        $response = $this->getBaseResponse();
        $response->method('getStatusCode')->willReturn($statusCode);

        $response->expects($this->once())->method('flush');
        $response->send();
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
