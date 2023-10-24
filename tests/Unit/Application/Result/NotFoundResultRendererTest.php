<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Application\Response\NotFoundResponse;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResultRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\NotFoundResultRenderer
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Response\ContentResponse
 * @uses \Kartenmacherei\HttpFramework\Application\Response\NotFoundResponse
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

    /** @return MockObject|Content */
    private function getContentMock()
    {
        return $this->createMock(Content::class);
    }

    /** @return MockObject|NotFoundResult */
    private function getNotFoundResultMock()
    {
        return $this->createMock(NotFoundResult::class);
    }
}
