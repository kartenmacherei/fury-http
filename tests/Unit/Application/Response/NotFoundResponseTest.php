<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\HtmlContentType;
use Fury\Application\NotFoundResponse;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\NotFoundResponse
 */
class NotFoundResponseTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedContentTypeHeader()
    {
        $content = $this->getContentMock();
        $content->method('getContentType')->willReturn(new HtmlContentType());
        $response = new NotFoundResponse($content);
        ob_start();
        $response->send();
        ob_end_clean();

        $this->assertSame(
            ['Content-Type: text/html; charset=UTF-8'], xdebug_get_headers()
        );
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Content
     */
    private function getContentMock()
    {
        return $this->createMock(Content::class);
    }
}
