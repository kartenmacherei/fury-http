<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand;
use Kartenmacherei\HttpFramework\Application\Routing\NotFoundPutRoute;
use Kartenmacherei\HttpFramework\Http\Request\PutRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Routing\NotFoundPutRoute
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\PutRoute
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand
 */
class NotFoundPutRouteTest extends TestCase
{
    public function testReturnsExpectedCommand(): void
    {
        $request = $this->getPutRequestMock();
        $request = $this->getPutRequestMock();

        $route = new NotFoundPutRoute();
        $actual = $route->route($request);

        $this->assertInstanceOf(NotFoundCommand::class, $actual);
    }

    private function getPutRequestMock(): PutRequest&MockObject
    {
        return $this->createMock(PutRequest::class);
    }
}
