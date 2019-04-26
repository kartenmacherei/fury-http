<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\NoNextRouteException;
use Fury\Http\Result;
use Fury\Http\ResultRenderer;
use Fury\Http\ResultRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\ResultRoute
 */
class ResultRouteTest extends TestCase
{
    /**
     * @var MockObject|ResultRoute
     */
    private $route;

    protected function setUp(): void
    {
        $this->route = $this->getResultRoute();
    }

    public function testRouteThrowsExceptionOfNoNextRouteIsAvailable(): void
    {
        $result = $this->getResultMock();
        $this->expectException(NoNextRouteException::class);
        $this->route->route($result);
    }

    public function testReturnsCommandIfCanRouteReturnsTrue(): void
    {
        $resultRenderer = $this->getResultRendererMock();
        $this->route->method('canRoute')->willReturn(true);
        $this->route->method('getResultRenderer')->willReturn($resultRenderer);

        $this->assertSame($resultRenderer, $this->route->route($this->getResultMock()));
    }

    public function testInvokesNextRouteIfCanRouteReturnsFalse(): void
    {
        $resultRenderer = $this->getResultRendererMock();

        $result = $this->getResultMock();

        $nextRoute = $this->getResultRouteMock();
        $nextRoute->expects($this->once())
            ->method('route')
            ->with($result)
            ->willReturn($resultRenderer);

        $this->route->method('canRoute')->willReturn(false);
        $this->route->setNextRoute($nextRoute);

        $this->assertSame($resultRenderer, $this->route->route($result));
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

    /**
     * @return MockObject|ResultRenderer
     */
    private function getResultRendererMock()
    {
        return $this->createMock(ResultRenderer::class);
    }

    private function getResultRoute()
    {
        return $this->getMockForAbstractClass(ResultRoute::class);
    }
}
