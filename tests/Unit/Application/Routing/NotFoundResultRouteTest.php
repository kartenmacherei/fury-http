<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\NotFoundResult;
use Fury\Application\NotFoundResultRenderer;
use Fury\Application\NotFoundResultRoute;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\NotFoundResultRoute
 * @covers \Fury\Http\ResultRoute
 *
 * @uses \Fury\Application\NotFoundResultRenderer
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
     * @return PHPUnit_Framework_MockObject_MockObject|NotFoundResult
     */
    private function getNotFoundResultMock()
    {
        return $this->createMock(NotFoundResult::class);
    }
}
