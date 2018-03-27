<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\PostRequest;
use Fury\Http\PostRoute;
use Fury\Http\NoNextRouteException;
use Fury\Http\Command;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\PostRoute
 */
class PostRouteTest extends TestCase
{
    /**
     * @var MockObject|PostRoute
     */
    private $route;

    protected function setUp()
    {
        $this->route = $this->getPostRoute();
    }


    public function testRouteThrowsExceptionOfNoNextRouteIsAvailable()
    {
        $request = $this->getPostRequestMock();
        $this->expectException(NoNextRouteException::class);
        $this->route->route($request);
    }

    public function testReturnsCommandIfCanRouteReturnsTrue()
    {
        $command = $this->getCommandMock();
        $this->route->method('canRoute')->willReturn(true);
        $this->route->method('getCommand')->willReturn($command);

        $this->assertSame($command, $this->route->route($this->getPostRequestMock()));
    }

    public function testInvokesNextRouteIfCanRouteReturnsFalse()
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
