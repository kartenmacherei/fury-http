<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\GetRequest;
use Kartenmacherei\HttpFramework\Http\Routing\GetRoute;
use Kartenmacherei\HttpFramework\Http\Routing\GetRouter;
use Kartenmacherei\HttpFramework\Http\Routing\NoRoutesException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\GetRouter
 */
class GetRouterTest extends TestCase
{
    public function testThrowsExceptionIfFirstRouteIsNotSet(): void
    {
        $router = new GetRouter();
        $this->expectException(NoRoutesException::class);

        $router->route($this->getGetRequestMock());
    }

    public function testAddRouteWithFirstRoute(): void
    {
        $route = $this->getGetRouteMock();
        $route->expects($this->once())->method('route');

        $router = new GetRouter();
        $router->addRoute($route);

        $router->route($this->getGetRequestMock());
    }

    public function testAddRouteSetsAddsRouteAsNextRoute(): void
    {
        $route1 = $this->getGetRouteMock();
        $route2 = $this->getGetRouteMock();

        $route1->expects($this->once())->method('setNextRoute')->with($route2);

        $router = new GetRouter();
        $router->addRoute($route1);
        $router->addRoute($route2);

        $router->route($this->getGetRequestMock());
    }

    /** @return MockObject|GetRoute */
    private function getGetRouteMock()
    {
        return $this->createMock(GetRoute::class);
    }

    /** @return MockObject|GetRequest */
    private function getGetRequestMock()
    {
        return $this->createMock(GetRequest::class);
    }
}
