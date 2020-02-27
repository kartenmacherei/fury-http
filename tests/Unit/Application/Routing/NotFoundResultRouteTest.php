<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResultRenderer;
use Kartenmacherei\HttpFramework\Application\Routing\NotFoundResultRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Routing\NotFoundResultRoute
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\ResultRoute
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Result\NotFoundResultRenderer
 */
class NotFoundResultRouteTest extends TestCase
{
    public function testReturnsExpectedResultRenderer(): void
    {
        $result = $this->getNotFoundResultMock();

        $route = new NotFoundResultRoute();
        $actual = $route->route($result);

        $this->assertInstanceOf(NotFoundResultRenderer::class, $actual);
    }

    /**
     * @return MockObject|NotFoundResult
     */
    private function getNotFoundResultMock()
    {
        return $this->createMock(NotFoundResult::class);
    }
}
