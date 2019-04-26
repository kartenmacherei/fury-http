<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\NotFoundCommand;
use Fury\Application\NotFoundPostRoute;
use Fury\Http\PostRequest;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\NotFoundPostRoute
 * @covers \Fury\Http\PostRoute
 *
 * @uses \Fury\Application\NotFoundCommand
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
     * @return PHPUnit_Framework_MockObject_MockObject|PostRequest
     */
    private function getPostRequestMock()
    {
        return $this->createMock(PostRequest::class);
    }
}
