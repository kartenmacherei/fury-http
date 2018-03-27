<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Result;
use Fury\Http\ResultRoute;
use Fury\Http\ResultRouter;
use Fury\Http\NoRoutesException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\ResultRouter
 */
class ResultRouterTest extends TestCase
{
    public function testThrowsExceptionIfFirstRouteIsNotSet()
    {
        $router = new ResultRouter();
        $this->expectException(NoRoutesException::class);

        $router->route($this->getResultMock());
    }

    public function testAddRouteWithFirstRoute()
    {
        $route = $this->getResultRouteMock();
        $route->expects($this->once())->method('route');

        $router = new ResultRouter();
        $router->addRoute($route);

        $router->route($this->getResultMock());
    }

    public function testAddRouteSetsAddsRouteAsNextRoute()
    {
        $route1 = $this->getResultRouteMock();
        $route2 = $this->getResultRouteMock();

        $route1->expects($this->once())->method('setNextRoute')->with($route2);

        $router = new ResultRouter();
        $router->addRoute($route1);
        $router->addRoute($route2);

        $router->route($this->getResultMock());
    }

    /**
     * @return MockObject|ResultRoute
     */
    private function getResultRouteMock()
    {
        return $this->createMock(ResultRoute::class);
    }

    /**
     * @return MockObject|Result
     */
    private function getResultMock()
    {
        return $this->createMock(Result::class);
    }
}
