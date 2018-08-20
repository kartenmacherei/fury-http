<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\RedirectResult;
use Fury\Http\UriPath;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Fury\Application\RedirectResult
 */
class RedirectResultTest extends TestCase
{
    public function testGetContentReturnsExpectedContent()
    {
        /** @var UriPath|PHPUnit_Framework_MockObject_MockObject $contentMock */
        $uriPathMock = $this->createMock(UriPath::class);

        $result = new RedirectResult($uriPathMock);
        $this->assertSame($uriPathMock, $result->getUriPath());
    }
}
