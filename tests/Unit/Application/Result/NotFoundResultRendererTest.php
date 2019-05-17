<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content\Content;
use Fury\Application\Response\NotFoundResponse;
use Fury\Application\Result\NotFoundResult;
use Fury\Application\Result\NotFoundResultRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Result\NotFoundResultRenderer
 *
 * @uses \Fury\Application\Response\ContentResponse
 * @uses \Fury\Application\Response\NotFoundResponse
 */
class NotFoundResultRendererTest extends TestCase
{
    public function testReturnsExpectedResponse(): void
    {
        $content = $this->getContentMock();
        $result = $this->getNotFoundResultMock();
        $result->method('getContent')->willReturn($content);

        $renderer = new NotFoundResultRenderer($result);

        $actual = $renderer->render();
        $expected = new NotFoundResponse($content);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return MockObject|Content
     */
    private function getContentMock()
    {
        return $this->createMock(Content::class);
    }

    /**
     * @return MockObject|NotFoundResult
     */
    private function getNotFoundResultMock()
    {
        return $this->createMock(NotFoundResult::class);
    }
}
