<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Command;
use Fury\Http\Request\PostRequest;
use Fury\Http\Routing\NoNextRouteException;
use Fury\Http\Routing\PostRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Routing\PostRoute
 */
class PostRouteTest extends TestCase
{
    /**
     * @var MockObject|PostRoute
     */
    private $route;

    protected function setUp(): void
    {
        $this->route = $this->getPostRoute();
    }

    public function testRouteThrowsExceptionOfNoNextRouteIsAvailable(): void
    {
        $request = $this->getPostRequestMock();
        $this->expectException(NoNextRouteException::class);
        $this->route->route($request);
    }

    public function testReturnsCommandIfCanRouteReturnsTrue(): void
    {
        $command = $this->getCommandMock();
        $this->route->method('canRoute')->willReturn(true);
        $this->route->method('getCommand')->willReturn($command);

        $this->assertSame($command, $this->route->route($this->getPostRequestMock()));
    }

    public function testInvokesNextRouteIfCanRouteReturnsFalse(): void
    {
        $request = $this->getPostRequestMock();

        $command = $this->getCommandMock();

        $nextRoute = $this->getPostRouteMock();
        $nextRoute->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($command);

        $this->route->method('canRoute')->willReturn(false);
        $this->route->setNextRoute($nextRoute);

        $this->assertSame($command, $this->route->route($this->getPostRequestMock()));
    }

    /**
     * @return MockObject|PostRoute
     */
    private function getPostRouteMock()
    {
        return $this->createMock(PostRoute::class);
    }

    /**
     * @return MockObject|Command
     */
    private function getCommandMock()
    {
        return $this->createMock(Command::class);
    }

    /**
     * @return MockObject|PostRequest
     */
    private function getPostRequestMock()
    {
        return $this->createMock(PostRequest::class);
    }

    private function getPostRoute()
    {
        return $this->getMockForAbstractClass(PostRoute::class);
    }
}
