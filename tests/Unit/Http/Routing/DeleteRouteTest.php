<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;
use Kartenmacherei\HttpFramework\Http\Routing\DeleteRoute;
use Kartenmacherei\HttpFramework\Http\Routing\NoNextRouteException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\DeleteRoute
 */
class DeleteRouteTest extends TestCase
{
    private DeleteRoute&MockObject$route;

    protected function setUp(): void
    {
        $this->route = $this->getDeleteRoute();
    }

    public function testRouteThrowsExceptionOfNoNextRouteIsAvailable(): void
    {
        $request = $this->getDeleteRequestMock();
        $this->expectException(NoNextRouteException::class);
        $this->route->route($request);
    }

    public function testReturnsCommandIfCanRouteReturnsTrue(): void
    {
        $command = $this->getCommandMock();
        $this->route->method('canRoute')->willReturn(true);
        $this->route->method('getCommand')->willReturn($command);

        $this->assertSame($command, $this->route->route($this->getDeleteRequestMock()));
    }

    public function testInvokesNextRouteIfCanRouteReturnsFalse(): void
    {
        $request = $this->getDeleteRequestMock();

        $command = $this->getCommandMock();

        $nextRoute = $this->getDeleteRouteMock();
        $nextRoute->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($command);

        $this->route->method('canRoute')->willReturn(false);
        $this->route->setNextRoute($nextRoute);

        $this->assertSame($command, $this->route->route($this->getDeleteRequestMock()));
    }

    private function getDeleteRouteMock(): DeleteRoute&MockObject
    {
        return $this->createMock(DeleteRoute::class);
    }

    private function getCommandMock(): Command&MockObject
    {
        return $this->createMock(Command::class);
    }

    private function getDeleteRequestMock(): DeleteRequest&MockObject
    {
        return $this->createMock(DeleteRequest::class);
    }

    private function getDeleteRoute(): DeleteRoute&MockObject
    {
        return $this->getMockForAbstractClass(DeleteRoute::class);
    }
}
