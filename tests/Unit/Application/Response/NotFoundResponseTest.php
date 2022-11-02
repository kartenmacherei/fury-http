<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Application\Content\ContentType;
use Kartenmacherei\HttpFramework\Application\Response\NotFoundResponse;
use Kartenmacherei\HttpFramework\UnitTest\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Response\NotFoundResponse
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
            ['Content-Type: text/html; charset=UTF-8'],
            xdebug_get_headers()
        );
    }

    /**
     * @return MockObject|Content
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
