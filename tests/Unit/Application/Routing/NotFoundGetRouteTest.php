<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Application;

use Kartenmacherei\HttpFramework\Application\Query\NotFoundQuery;
use Kartenmacherei\HttpFramework\Application\Routing\NotFoundGetRoute;
use Kartenmacherei\HttpFramework\Http\Request\GetRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Routing\NotFoundGetRoute
 * @covers \Kartenmacherei\HttpFramework\Http\Routing\GetRoute
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Query\NotFoundQuery
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
