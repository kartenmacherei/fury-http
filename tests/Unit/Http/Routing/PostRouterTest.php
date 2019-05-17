<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Request\PostRequest;
use Fury\Http\Routing\NoRoutesException;
use Fury\Http\Routing\PostRoute;
use Fury\Http\Routing\PostRouter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Routing\PostRouter
 */
class PostRouterTest extends TestCase
{
    public function testThrowsExceptionIfFirstRouteIsNotSet(): void
    {
        $router = new PostRouter();
        $this->expectException(NoRoutesException::class);

        $router->route($this->getPostRequestMock());
    }

    public function testAddRouteWithFirstRoute(): void
    {
        $route = $this->getPostRouteMock();
        $route->expects($this->once())->method('route');

        $router = new PostRouter();
        $router->addRoute($route);

        $router->route($this->getPostRequestMock());
    }

    public function testAddRouteSetsAddsRouteAsNextRoute(): void
    {
        $route1 = $this->getPostRouteMock();
        $route2 = $this->getPostRouteMock();

        $route1->expects($this->once())->method('setNextRoute')->with($route2);

        $router = new PostRouter();
        $router->addRoute($route1);
        $router->addRoute($route2);

        $router->route($this->getPostRequestMock());
    }

    /**
     * @return MockObject|PostRoute
     */
    private function getPostRouteMock()
    {
        return $this->createMock(PostRoute::class);
    }

    /**
     * @return MockObject|PostRequest
     */
    private function getPostRequestMock()
    {
        return $this->createMock(PostRequest::class);
    }
}
