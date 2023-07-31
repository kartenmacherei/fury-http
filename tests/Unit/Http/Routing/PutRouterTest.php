<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\PutRequest;
use Kartenmacherei\HttpFramework\Http\Routing\NoRoutesException;
use Kartenmacherei\HttpFramework\Http\Routing\PutRoute;
use Kartenmacherei\HttpFramework\Http\Routing\PutRouter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\PutRouter
 */
class PutRouterTest extends TestCase
{
    public function testThrowsExceptionIfFirstRouteIsNotSet(): void
    {
        $router = new PutRouter();
        $this->expectException(NoRoutesException::class);

        $router->route($this->getPutRequestMock());
    }

    public function testAddRouteWithFirstRoute(): void
    {
        $route = $this->getPutRouteMock();
        $route->expects($this->once())->method('route');

        $router = new PutRouter();
        $router->addRoute($route);

        $router->route($this->getPutRequestMock());
    }

    public function testAddRouteSetsAddsRouteAsNextRoute(): void
    {
        $route1 = $this->getPutRouteMock();
        $route2 = $this->getPutRouteMock();

        $route1->expects($this->once())->method('setNextRoute')->with($route2);

        $router = new PutRouter();
        $router->addRoute($route1);
        $router->addRoute($route2);

        $router->route($this->getPutRequestMock());
    }

    /**
     * @return MockObject|PutRoute
     */
    private function getPutRouteMock()
    {
        return $this->createMock(PutRoute::class);
    }

    /**
     * @return MockObject|PutRequest
     */
    private function getPutRequestMock()
    {
        return $this->createMock(PutRequest::class);
    }
}
