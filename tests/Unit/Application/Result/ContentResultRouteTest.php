<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Result\ContentResult;
use Fury\Application\Result\ContentResultRenderer;
use Fury\Application\Result\ContentResultRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Result\ContentResultRoute
 * @covers \Fury\Http\ResultRoute
 *
 * @uses \Fury\Application\Result\ContentResultRenderer
 */
class ContentResultRouteTest extends TestCase
{
    public function testReturnsExpectedResultRenderer(): void
    {
        $result = $this->getContentResultMock();

        $route = new ContentResultRoute();
        $actual = $route->route($result);
        $expected = new ContentResultRenderer($result);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return MockObject|ContentResult
     */
    private function getContentResultMock()
    {
        return $this->createMock(ContentResult::class);
    }
}
