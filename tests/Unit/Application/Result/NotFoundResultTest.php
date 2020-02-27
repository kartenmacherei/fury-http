<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Application;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\NotFoundResult
 */
class NotFoundResultTest extends TestCase
{
    public function testReturnsExpectedContent(): void
    {
        $content = $this->getContentMock();
        $result = new NotFoundResult($content);
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
