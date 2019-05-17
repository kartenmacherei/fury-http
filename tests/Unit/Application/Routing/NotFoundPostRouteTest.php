<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Command\NotFoundCommand;
use Fury\Application\Routing\NotFoundPostRoute;
use Fury\Http\Request\PostRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Routing\NotFoundPostRoute
 * @covers \Fury\Http\Routing\PostRoute
 *
 * @uses \Fury\Application\Command\NotFoundCommand
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

    /**
     * @return MockObject|PostRequest
     */
    private function getPostRequestMock()
    {
        return $this->createMock(PostRequest::class);
    }
}
