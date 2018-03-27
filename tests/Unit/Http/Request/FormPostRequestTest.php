<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\FormPostRequest;
use Fury\Http\RequestCookieJar;
use Fury\Http\RequestParameterNotFoundException;
use Fury\Http\UriPath;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\FormPostRequest
 * @uses \Fury\Http\Request
 */
class FormPostRequestTest extends TestCase
{
    /**
     * @var FormPostRequest
     */
    private $request;
    
    protected function setUp()
    {
        $this->request = new FormPostRequest(
            $this->getUriPathMock(),
            $this->getRequestCookieJarMock(),
            ['foo' => 'bar']
        );
    }

    public function testHasParametersReturnsTrue()
    {
        $this->assertTrue($this->request->hasParameters());
    }

    public function testHasParameterReturnsExpectedValue()
    {
        $this->assertTrue($this->request->hasParameter('foo'));
        $this->assertFalse($this->request->hasParameter('baz'));
    }

    public function testGetParameterThrowsExceptionIfParameterIsNotPresent()
    {
        $this->expectException(RequestParameterNotFoundException::class);
        $this->request->getParameter('baz');
    }

    public function testGetParameterReturnsExpectedValue()
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
