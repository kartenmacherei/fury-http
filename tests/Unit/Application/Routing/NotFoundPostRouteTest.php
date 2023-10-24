<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand;
use Kartenmacherei\HttpFramework\Application\Routing\NotFoundPostRoute;
use Kartenmacherei\HttpFramework\Http\Request\PostRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Routing\NotFoundPostRoute
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\PostRoute
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand
 */
class NotFoundPostRouteTest extends TestCase
{
    public function testReturnsExpectedCommand(): void
    {
        $request = $this->getPostRequestMock();

        $route = new NotFoundPostRoute();
        $actual = $route->route($request);

        $this->assertInstanceOf(NotFoundCommand::class, $actual);
    }

    /** @return MockObject|PostRequest */
    private function getPostRequestMock()
    {
        return $this->createMock(PostRequest::class);
    }
}
