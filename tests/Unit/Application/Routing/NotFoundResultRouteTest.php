<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Result\NotFoundResult;
use Fury\Application\Result\NotFoundResultRenderer;
use Fury\Application\Routing\NotFoundResultRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Routing\NotFoundResultRoute
 * @covers \Fury\Http\Routing\ResultRoute
 *
 * @uses \Fury\Application\Result\NotFoundResultRenderer
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
