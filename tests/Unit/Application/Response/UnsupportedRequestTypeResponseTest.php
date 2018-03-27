<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\UnsupportedRequestTypeResponse;
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
        ob_start();
        $response->send();
        ob_end_clean();

        $this->assertSame(405, http_response_code());
    }
}
