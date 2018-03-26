<?php declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\ContentResult;
use Fury\Application\ContentResultRenderer;
use Fury\Application\ContentResultRoute;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\ContentResultRoute
 * @covers \Fury\Http\ResultRoute
 * @uses \Fury\Application\ContentResultRenderer
 */
class ContentResultRouteTest extends TestCase
{
    public function testReturnsExpectedResultRenderer()
    {
        $result = $this->getContentResultMock();

        $route = new ContentResultRoute();
        $actual = $route->route($result);
        $expected = new ContentResultRenderer($result);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ContentResult
     */
    private function getContentResultMock()
    {
        return $this->createMock(ContentResult::class);
    }
}
