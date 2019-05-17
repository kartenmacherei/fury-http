<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Query\NotFoundQuery;
use Fury\Application\Routing\NotFoundGetRoute;
use Fury\Http\Request\GetRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Routing\NotFoundGetRoute
 * @covers \Fury\Http\Routing\GetRoute
 *
 * @uses \Fury\Application\Routing\NotFoundQuery
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
     * @return MockObject|GetRequest
     */
    private function getGetRequestMock()
    {
        return $this->createMock(GetRequest::class);
    }
}
