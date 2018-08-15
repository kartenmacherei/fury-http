<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\RedirectRenderer;
use Fury\Application\RedirectResponse;
use Fury\Application\RedirectResult;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\RedirectRenderer
 *
 * @uses \Fury\Application\ContentResponse
 */
class RedirectRendererTest extends TestCase
{
    /**
     * @var Content|PHPUnit_Framework_MockObject_MockObject
     */
    private $contentMock;

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

        $this->contentMock = $this->createMock(Content::class);
        $this->redirectResultMock = $this->createMock(RedirectResult::class);

        $this->renderer = new RedirectRenderer($this->redirectResultMock);
    }

    public function testIfRenderReturnsExpectedResponse()
    {
        $this->redirectResultMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->contentMock);

        $expectedResponse = new RedirectResponse($this->contentMock);
        $this->assertEquals($expectedResponse, $this->renderer->render());
    }
}
