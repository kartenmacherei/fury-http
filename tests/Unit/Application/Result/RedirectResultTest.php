<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Result\RedirectResult;
use Kartenmacherei\HttpFramework\Http\Domain;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Result\RedirectResult
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Domain
 */
class RedirectResultTest extends TestCase
{
    public function testGetContentReturnsExpectedContent(): void
    {
        /** @var UriPath|MockObject $contentMock */
        $uriPathMock = $this->createMock(UriPath::class);
        $expectedParameters = ['foo' => '1', 'bar' => 'baz'];
        $expectedDomain = new Domain('kartenmacherei.de');

        $result = new RedirectResult($uriPathMock, $expectedParameters, $expectedDomain);
        $this->assertSame($uriPathMock, $result->getUriPath());
        $this->assertSame($expectedParameters, $result->getParameters());
        $this->assertSame($expectedDomain, $result->getDomain());
    }
}
