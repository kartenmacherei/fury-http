<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Application;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Application\Response\ContentResponse;
use Kartenmacherei\HttpFramework\Application\Result\ContentResult;
use Kartenmacherei\HttpFramework\Application\Result\ContentResultRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\ContentResultRenderer
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Response\ContentResponse
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
