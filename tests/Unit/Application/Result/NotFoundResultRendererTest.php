<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\NotFoundResponse;
use Fury\Application\NotFoundResult;
use Fury\Application\NotFoundResultRenderer;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\NotFoundResultRenderer
 *
 * @uses \Fury\Application\ContentResponse
 * @uses \Fury\Application\NotFoundResponse
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
     * @return PHPUnit_Framework_MockObject_MockObject|Content
     */
    private function getContentMock()
    {
        return $this->createMock(Content::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|NotFoundResult
     */
    private function getNotFoundResultMock()
    {
        return $this->createMock(NotFoundResult::class);
    }
}
