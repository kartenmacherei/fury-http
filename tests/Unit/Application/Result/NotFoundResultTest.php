<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content\Content;
use Fury\Application\Result\NotFoundResult;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Result\NotFoundResult
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
