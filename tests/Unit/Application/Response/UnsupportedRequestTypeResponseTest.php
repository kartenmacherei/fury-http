<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\UnsupportedRequestTypeResponse;
use Fury\Http\ResponseCookie;
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
        $response = new UnsupportedRequestTypeResponse();
        $responseCookie = $this->createMock(ResponseCookie::class);
        $responseCookie->expects($this->never())
            ->method('send');

        ob_start();
        $response->addCookie($responseCookie);
        $response->send();
        ob_end_clean();

        $this->assertSame(405, http_response_code());
    }
}
