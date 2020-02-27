<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Application\Result\ContentResult;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\ContentResult
 */
class ContentResultTest extends TestCase
{
    public function testReturnsExpectedContent(): void
    {
        $content = $this->getContentMock();
        $result = new ContentResult($content);
        $this->assertSame($content, $result->getContent());
    }

    /**
     * @return MockObject|Content
     */
    private function getContentMock()
    {
        return $this->createMock(Content::class);
    }
}
