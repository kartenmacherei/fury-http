<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Query;
use Fury\Http\Request\GetRequest;
use Fury\Http\Routing\GetRoute;
use Fury\Http\Routing\NoNextRouteException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\GetRoute
 */
class GetRouteTest extends TestCase
{
    /**
     * @var MockObject|GetRoute
     */
    private $route;

    protected function setUp(): void
    {
        $this->route = $this->getGetRoute();
    }

    public function testRouteThrowsExceptionOfNoNextRouteIsAvailable(): void
    {
        $request = $this->getGetRequestMock();
        $this->expectException(NoNextRouteException::class);
        $this->route->route($request);
    }

    public function testReturnsQueryIfCanRouteReturnsTrue(): void
    {
        $query = $this->getQueryMock();
        $this->route->method('canRoute')->willReturn(true);
        $this->route->method('getQuery')->willReturn($query);

        $this->assertSame($query, $this->route->route($this->getGetRequestMock()));
    }

    public function testInvokesNextRouteIfCanRouteReturnsFalse(): void
    {
        $request = $this->getGetRequestMock();

        $query = $this->getQueryMock();

        $nextRoute = $this->getGetRouteMock();
        $nextRoute->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($query);

        $this->route->method('canRoute')->willReturn(false);
        $this->route->setNextRoute($nextRoute);

        $this->assertSame($query, $this->route->route($this->getGetRequestMock()));
    }

    /**
     * @return MockObject|GetRoute
     */
    private function getGetRouteMock()
    {
        return $this->createMock(GetRoute::class);
    }

    /**
     * @return MockObject|Query
     */
    private function getQueryMock()
    {
        return $this->createMock(Query::class);
    }

    /**
     * @return MockObject|GetRequest
     */
    private function getGetRequestMock()
    {
        return $this->createMock(GetRequest::class);
    }

    private function getGetRoute()
    {
        return $this->getMockForAbstractClass(GetRoute::class);
    }
}
