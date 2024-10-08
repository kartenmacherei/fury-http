<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Response\RedirectResponse;
use Kartenmacherei\HttpFramework\Application\Result\RedirectRenderer;
use Kartenmacherei\HttpFramework\Application\Result\RedirectResult;
use Kartenmacherei\HttpFramework\Http\Domain;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\RedirectRenderer
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Response\RedirectResponse
 * @uses \Kartenmacherei\HttpFramework\Http\Domain
 */
class RedirectRendererTest extends TestCase
{
    /** @var UriPath|MockObject */
    private $uriPathMock;

    /** @var RedirectResult|MockObject */
    private $redirectResultMock;

    /** @var RedirectRenderer */
    private $renderer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->uriPathMock = $this->createMock(UriPath::class);
        $this->redirectResultMock = $this->createMock(RedirectResult::class);

        $this->renderer = new RedirectRenderer($this->redirectResultMock);
    }

    public function testIfRenderReturnsExpectedResponse(): void
    {
        $this->redirectResultMock->expects($this->once())
            ->method('getUriPath')
            ->willReturn($this->uriPathMock);

        $this->redirectResultMock->expects($this->once())
            ->method('getParameters')
            ->willReturn([]);

        $this->redirectResultMock->expects($this->once())
            ->method('getDomain')
            ->willReturn(new Domain('kartenmacherei.de'));

        $expectedResponse = new RedirectResponse($this->uriPathMock, [], new Domain('kartenmacherei.de'));
        $this->assertEquals($expectedResponse, $this->renderer->render());
    }
}
