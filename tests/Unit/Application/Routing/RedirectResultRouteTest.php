<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Result\RedirectRenderer;
use Kartenmacherei\HttpFramework\Application\Result\RedirectResult;
use Kartenmacherei\HttpFramework\Application\Routing\RedirectResultRoute;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Routing\RedirectResultRoute
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Result\RedirectRenderer
 * @uses \Kartenmacherei\HttpFramework\Http\Routing\ResultRoute
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
