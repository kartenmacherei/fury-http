<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Result\RedirectResult;
use Fury\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Result\RedirectResult
 */
class RedirectResultTest extends TestCase
{
    public function testGetContentReturnsExpectedContent(): void
    {
        /** @var UriPath|MockObject $contentMock */
        $uriPathMock = $this->createMock(UriPath::class);

        $result = new RedirectResult($uriPathMock);
        $this->assertSame($uriPathMock, $result->getUriPath());
    }
}
