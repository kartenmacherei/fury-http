<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Http;

use Kartenmacherei\HttpFramework\Http\Request\FormPostRequest;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookieJar;
use Kartenmacherei\HttpFramework\Http\Request\RequestParameterNotFoundException;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\FormPostRequest
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\Request
 */
class FormPostRequestTest extends TestCase
{
    /**
     * @var FormPostRequest
     */
    private $request;

    protected function setUp(): void
    {
        $this->request = new FormPostRequest(
            $this->getUriPathMock(),
            $this->getRequestCookieJarMock(),
            ['foo' => 'bar']
        );
    }

    public function testHasParametersReturnsTrue(): void
    {
        $this->assertTrue($this->request->hasParameters());
    }

    public function testHasParameterReturnsExpectedValue(): void
    {
        $this->assertTrue($this->request->hasParameter('foo'));
        $this->assertFalse($this->request->hasParameter('baz'));
    }

    public function testGetParameterThrowsExceptionIfParameterIsNotPresent(): void
    {
        $this->expectException(RequestParameterNotFoundException::class);
        $this->request->getParameter('baz');
    }

    public function testGetParameterReturnsExpectedValue(): void
    {
        $this->assertSame('bar', $this->request->getParameter('foo'));
    }

    /**
     * @return MockObject|RequestCookieJar
     */
    private function getRequestCookieJarMock()
    {
        return $this->createMock(RequestCookieJar::class);
    }

    /**
     * @return MockObject|UriPath
     */
    private function getUriPathMock()
    {
        return $this->createMock(UriPath::class);
    }
}
