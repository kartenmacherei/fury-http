<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Result\RedirectRenderer;
use Fury\Application\Result\RedirectResult;
use Fury\Application\Routing\RedirectResultRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Routing\RedirectResultRoute
 *
 * @uses \Fury\Application\Result\RedirectRenderer
 * @uses \Fury\Http\Routing\ResultRoute
 */
class RedirectResultRouteTest extends TestCase
{
    public function testReturnsExpectedResultRenderer(): void
    {
        /** @var RedirectResult|MockObject $resultMock */
        $resultMock = $this->createMock(RedirectResult::class);

        $route = new RedirectResultRoute();
        $this->assertInstanceOf(RedirectRenderer::class, $route->route($resultMock));
    }
}
