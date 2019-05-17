<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content\Content;
use Fury\Application\Response\ContentResponse;
use Fury\Application\Result\ContentResult;
use Fury\Application\Result\ContentResultRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Result\ContentResultRenderer
 *
 * @uses \Fury\Application\Response\ContentResponse
 */
class ContentResultRendererTest extends TestCase
{
    public function testReturnsExpectedResponse(): void
    {
        $content = $this->getContentMock();
        $result = $this->getContentResultMock();
        $result->method('getContent')->willReturn($content);

        $renderer = new ContentResultRenderer($result);

        $actual = $renderer->render();
        $expected = new ContentResponse($content);

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
     * @return MockObject|ContentResult
     */
    private function getContentResultMock()
    {
        return $this->createMock(ContentResult::class);
    }
}
