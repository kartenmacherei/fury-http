<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\RedirectResponse;
use Fury\Http\RedirectStatusCode;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\RedirectResponse
 *
 * @uses \Fury\Application\Content
 * @uses \Fury\Application\ContentResponse
 */
class RedirectResponseTest extends TestCase
{
    public function testIfGetStatusCodeReturnsExpectedObject()
    {
        $expectedStatusCode = new RedirectStatusCode();

        /** @var Content|PHPUnit_Framework_MockObject_MockObject $contentMock */
        $contentMock = $this->createMock(Content::class);

        $response = new RedirectResponse($contentMock);
        $this->assertEquals($expectedStatusCode, $response->getStatusCode());
    }
}
