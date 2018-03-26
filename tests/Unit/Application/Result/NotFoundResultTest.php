<?php declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\NotFoundResult;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\NotFoundResult
 */
class NotFoundResultTest extends TestCase
{
    public function testReturnsExpectedContent()
    {
        $content = $this->getContentMock();
        $result = new NotFoundResult($content);
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
