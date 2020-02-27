<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Application;

use Kartenmacherei\HttpFramework\Application\Result\RedirectResult;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\RedirectResult
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
