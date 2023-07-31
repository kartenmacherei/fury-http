<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand;
use Kartenmacherei\HttpFramework\Application\Routing\NotFoundDeleteRoute;
use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Routing\NotFoundDeleteRoute
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\DeleteRoute
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand
 */
class NotFoundDeleteRouteTest extends TestCase
{
    public function testReturnsExpectedCommand(): void
    {
        $request = $this->getDeleteRequestMock();

        $route = new NotFoundDeleteRoute();
        $actual = $route->route($request);

        $this->assertInstanceOf(NotFoundCommand::class, $actual);
    }

    private function getDeleteRequestMock(): DeleteRequest&MockObject
    {
        return $this->createMock(DeleteRequest::class);
    }
}
