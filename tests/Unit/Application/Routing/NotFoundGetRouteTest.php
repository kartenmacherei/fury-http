<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\NotFoundGetRoute;
use Fury\Application\NotFoundQuery;
use Fury\Http\GetRequest;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\NotFoundGetRoute
 * @covers \Fury\Http\GetRoute
 *
 * @uses \Fury\Application\NotFoundQuery
 */
class NotFoundGetRouteTest extends TestCase
{
    public function testReturnsExpectedQuery(): void
    {
        $request = $this->getGetRequestMock();

        $route = new NotFoundGetRoute();
        $actual = $route->route($request);

        $this->assertInstanceOf(NotFoundQuery::class, $actual);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|GetRequest
     */
    private function getGetRequestMock()
    {
        return $this->createMock(GetRequest::class);
    }
}
