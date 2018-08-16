<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\RedirectRenderer;
use Fury\Application\RedirectResponse;
use Fury\Application\RedirectResult;
use Fury\Http\UriPath;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\RedirectRenderer
 *
 * @uses \Fury\Application\RedirectResponse
 */
class RedirectRendererTest extends TestCase
{
    /**
     * @var UriPath|PHPUnit_Framework_MockObject_MockObject
     */
    private $uriPathMock;

    /**
     * @var RedirectResult|PHPUnit_Framework_MockObject_MockObject
     */
    private $redirectResultMock;

    /**
     * @var RedirectRenderer
     */
    private $renderer;

    protected function setUp()
    {
        parent::setUp();

        $this->uriPathMock = $this->createMock(UriPath::class);
        $this->redirectResultMock = $this->createMock(RedirectResult::class);

        $this->renderer = new RedirectRenderer($this->redirectResultMock);
    }

    public function testIfRenderReturnsExpectedResponse()
    {
        $this->redirectResultMock->expects($this->once())
            ->method('getUriPath')
            ->willReturn($this->uriPathMock);

        $expectedResponse = new RedirectResponse($this->uriPathMock);
        $this->assertEquals($expectedResponse, $this->renderer->render());
    }
}
