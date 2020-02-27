<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Http;

use Kartenmacherei\HttpFramework\Http\Query;
use Kartenmacherei\HttpFramework\Http\Request\GetRequest;
use Kartenmacherei\HttpFramework\Http\Routing\GetRoute;
use Kartenmacherei\HttpFramework\Http\Routing\NoNextRouteException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\GetRoute
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
