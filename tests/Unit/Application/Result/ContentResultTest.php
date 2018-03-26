<?php declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\ContentResult;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\ContentResult
 */
class ContentResultTest extends TestCase
{
    public function testReturnsExpectedContent()
    {
        $content = $this->getContentMock();
        $result = new ContentResult($content);
        $this->assertSame($content, $result->getContent());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Content
     */
    private function getContentMock()
    {
        return $this->createMock(Content::class);
    }
}
