<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\RedirectRenderer;
use Fury\Application\RedirectResult;
use Fury\Application\RedirectResultRoute;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\RedirectResultRoute
 *
 * @uses \Fury\Application\RedirectRenderer
 * @uses \Fury\Http\ResultRoute
 */
class RedirectResultRouteTest extends TestCase
{
    public function testReturnsExpectedResultRenderer(): void
    {
        /** @var RedirectResult|PHPUnit_Framework_MockObject_MockObject $resultMock */
        $resultMock = $this->createMock(RedirectResult::class);

        $route = new RedirectResultRoute();
        $this->assertInstanceOf(RedirectRenderer::class, $route->route($resultMock));
    }
}
