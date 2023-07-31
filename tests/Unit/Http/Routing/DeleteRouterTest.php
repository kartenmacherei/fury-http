<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;
use Kartenmacherei\HttpFramework\Http\Routing\DeleteRoute;
use Kartenmacherei\HttpFramework\Http\Routing\DeleteRouter;
use Kartenmacherei\HttpFramework\Http\Routing\NoRoutesException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\DeleteRouter
 */
class DeleteRouterTest extends TestCase
{
    public function testThrowsExceptionIfFirstRouteIsNotSet(): void
    {
        $router = new DeleteRouter();
        $this->expectException(NoRoutesException::class);

        $router->route($this->getDeleteRequestMock());
    }

    public function testAddRouteWithFirstRoute(): void
    {
        $route = $this->getDeleteRouteMock();
        $route->expects($this->once())->method('route');

        $router = new DeleteRouter();
        $router->addRoute($route);

        $router->route($this->getDeleteRequestMock());
    }

    public function testAddRouteSetsAddsRouteAsNextRoute(): void
    {
        $route1 = $this->getDeleteRouteMock();
        $route2 = $this->getDeleteRouteMock();

        $route1->expects($this->once())->method('setNextRoute')->with($route2);

        $router = new DeleteRouter();
        $router->addRoute($route1);
        $router->addRoute($route2);

        $router->route($this->getDeleteRequestMock());
    }

    private function getDeleteRouteMock(): DeleteRoute&MockObject
    {
        return $this->createMock(DeleteRoute::class);
    }

    private function getDeleteRequestMock(): DeleteRequest&MockObject
    {
        return $this->createMock(DeleteRequest::class);
    }
}
