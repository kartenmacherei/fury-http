<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\ContentType;
use Fury\Application\NotFoundResponse;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\NotFoundResponse
 */
class NotFoundResponseTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    private const CONTENT_VALUE = 'foo';
    private const CONTENT_TYPE_VALUE = 'text/html';

    /**
     * @runInSeparateProcess
     */
    public function testSetsExpectedContentTypeHeader(): void
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();

        $this->expectOutputString(self::CONTENT_VALUE);
        $content = $this->getContentMock();

        $response = new NotFoundResponse($content);
        $response->send();

        $this->assertSame(
            ['Content-Type: text/html; charset=UTF-8'], xdebug_get_headers()
        );
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Content
     */
    private function getContentMock()
    {
        $contentMock = $this->createMock(Content::class);
        $contentTypeMock = $this->createMock(ContentType::class);

        $contentMock->expects($this->once())
            ->method('asString')
            ->willReturn(self::CONTENT_VALUE);

        $contentMock->expects($this->once())
            ->method('getContentType')
            ->willReturn($contentTypeMock);

        $contentTypeMock->expects($this->once())
            ->method('asString')
            ->willReturn(self::CONTENT_TYPE_VALUE);

        return $contentMock;
    }
}
