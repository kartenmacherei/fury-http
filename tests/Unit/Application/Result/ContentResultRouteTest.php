<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Result\ContentResult;
use Kartenmacherei\HttpFramework\Application\Result\ContentResultRenderer;
use Kartenmacherei\HttpFramework\Application\Result\ContentResultRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\ContentResultRoute
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\ResultRoute
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Result\ContentResultRenderer
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

    /** @return MockObject|ContentResult */
    private function getContentResultMock()
    {
        return $this->createMock(ContentResult::class);
    }
}
