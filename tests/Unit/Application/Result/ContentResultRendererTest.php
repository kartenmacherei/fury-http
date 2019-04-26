<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\ContentResponse;
use Fury\Application\ContentResult;
use Fury\Application\ContentResultRenderer;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\ContentResultRenderer
 *
 * @uses \Fury\Application\ContentResponse
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
     * @return PHPUnit_Framework_MockObject_MockObject|Content
     */
    private function getContentMock()
    {
        return $this->createMock(Content::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ContentResult
     */
    private function getContentResultMock()
    {
        return $this->createMock(ContentResult::class);
    }
}
