<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content;
use Fury\Application\RedirectResult;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\RedirectResult
 */
class RedirectResultTest extends TestCase
{
    public function testGetContentReturnsExpectedContent()
    {
        /** @var Content|PHPUnit_Framework_MockObject_MockObject $contentMock */
        $contentMock = $this->createMock(Content::class);

        $result = new RedirectResult($contentMock);
        $this->assertSame($contentMock, $result->getContent());
    }
}
