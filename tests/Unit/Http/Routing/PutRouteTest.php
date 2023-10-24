<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\PutRequest;
use Kartenmacherei\HttpFramework\Http\Routing\NoNextRouteException;
use Kartenmacherei\HttpFramework\Http\Routing\PutRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\PutRoute
 */
class PutRouteTest extends TestCase
{
    /** @var MockObject|PutRoute */
    private $route;

    protected function setUp(): void
    {
        $this->route = $this->getPutRoute();
    }

    public function testRouteThrowsExceptionOfNoNextRouteIsAvailable(): void
    {
        $request = $this->getPutRequestMock();
        $this->expectException(NoNextRouteException::class);
        $this->route->route($request);
    }

    public function testReturnsCommandIfCanRouteReturnsTrue(): void
    {
        $command = $this->getCommandMock();
        $this->route->method('canRoute')->willReturn(true);
        $this->route->method('getCommand')->willReturn($command);

        $this->assertSame($command, $this->route->route($this->getPutRequestMock()));
    }

    public function testInvokesNextRouteIfCanRouteReturnsFalse(): void
    {
        $request = $this->getPutRequestMock();

        $command = $this->getCommandMock();

        $nextRoute = $this->getPutRouteMock();
        $nextRoute->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($command);

        $this->route->method('canRoute')->willReturn(false);
        $this->route->setNextRoute($nextRoute);

        $this->assertSame($command, $this->route->route($this->getPutRequestMock()));
    }

    /** @return MockObject|PutRoute */
    private function getPutRouteMock()
    {
        return $this->createMock(PutRoute::class);
    }

    /** @return MockObject|Command */
    private function getCommandMock()
    {
        return $this->createMock(Command::class);
    }

    /** @return MockObject|PutRequest */
    private function getPutRequestMock()
    {
        return $this->createMock(PutRequest::class);
    }

    private function getPutRoute()
    {
        return $this->getMockForAbstractClass(PutRoute::class);
    }
}
