<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Response\RedirectResponse;
use Fury\Application\Result\RedirectRenderer;
use Fury\Application\Result\RedirectResult;
use Fury\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Result\RedirectRenderer
 *
 * @uses \Fury\Application\Response\RedirectResponse
 */
class RedirectRendererTest extends TestCase
{
    /**
     * @var UriPath|MockObject
     */
    private $uriPathMock;

    /**
     * @var RedirectResult|MockObject
     */
    private $redirectResultMock;

    /**
     * @var RedirectRenderer
     */
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

        $expectedResponse = new RedirectResponse($this->uriPathMock);
        $this->assertEquals($expectedResponse, $this->renderer->render());
    }
}
