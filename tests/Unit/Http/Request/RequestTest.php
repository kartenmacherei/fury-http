<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Application\ContentType;
use Fury\Http\FormPostRequest;
use Fury\Http\GetRequest;
use Fury\Http\JsonPostRequest;
use Fury\Http\RawPostRequest;
use Fury\Http\Request;
use Fury\Http\RequestCookie;
use Fury\Http\RequestCookieJar;
use Fury\Http\SupportedRequestMethods;
use Fury\Http\UnsupportedRequestMethodException;
use Fury\Http\UriPath;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Request
 */
class RequestTest extends TestCase
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var MockObject|UriPath
     */
    private $path;

    /**
     * @var MockObject|RequestCookieJar
     */
    private $cookieJar;

    /**
     * @var vfsStreamDirectory
     */
    private $vfs;

    protected function setUp()
    {
        $this->path = $this->getUriPathMock();
        $this->cookieJar = $this->getRequestCookieJarMock();

        $this->request = $this->getRequest();

        $this->vfs = vfsStream::setup();
    }

    public function testIsGetRequestReturnsFalse()
    {
        $this->assertFalse($this->request->isGetRequest());
    }

    public function testIsPostRequestReturnsFalse()
    {
        $this->assertFalse($this->request->isPostRequest());
    }

    public function testGetPathReturnsExpectedObject()
    {
        $this->assertSame($this->path, $this->request->getPath());
    }

    public function testHasCookieReturnsExpectedValue()
    {
        $this->cookieJar->method('hasCookie')->willReturnMap(
            [
                ['foo', true],
                ['bar', false],
            ]
        );

        $this->assertTrue($this->request->hasCookie('foo'));
        $this->assertFalse($this->request->hasCookie('bar'));
    }

    public function testGetCookieValueReturnsExpectedString()
    {
        $cookie = $this->getRequestCookieMock();
        $cookie->method('getValue')->willReturn('some value');

        $this->cookieJar->method('getCookie')
            ->with('some_cookie')
            ->willReturn($cookie);

        $this->assertSame('some value', $this->request->getCookieValue('some_cookie'));
    }

    /**
     * @runInSeparateProcess
     *
     * @dataProvider postRequestTestDataProvider
     *
     * @param string $contentType
     * @param string $inputStream
     * @param string $expectedClass
     *
     * @throws \Fury\Http\UnsupportedRequestMethodException
     */
    public function testCreatesExpectedFormPostRequest(string $contentType, string $inputStream, string $expectedClass)
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['DOCUMENT_URI'] = '/foo';
        $_SERVER['CONTENT_TYPE'] = $contentType;

        file_put_contents($this->vfs->url() . '/input', $inputStream);

        $this->assertInstanceOf($expectedClass, Request::fromSuperGlobals($this->vfs->url() . '/input'));
    }

    public function postRequestTestDataProvider()
    {
        return [
            [ContentType::WWW_FORM, '', FormPostRequest::class],
            [ContentType::WWW_FORM_UTF8, '', FormPostRequest::class],
            [ContentType::JSON, '{"foo":"bar"}', JsonPostRequest::class],
            [ContentType::JSON_UTF8, '{"foo":"bar"}', JsonPostRequest::class],
            ['', '', RawPostRequest::class],
            ['foo', '', RawPostRequest::class],
        ];
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreatesExpectedGetRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['DOCUMENT_URI'] = '/foo';
        $_GET = ['foo' => 'bar'];

        $expected = new GetRequest(new UriPath('/foo'), new RequestCookieJar(), $_GET);
        $this->assertEquals($expected, Request::fromSuperGlobals());
    }

    /**
     * @runInSeparateProcess
     */
    public function testThrowsExceptionIfRequestMethodIsNotSupported()
    {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['DOCUMENT_URI'] = '/foo';
        $this->expectException(UnsupportedRequestMethodException::class);

        Request::fromSuperGlobals();
    }

    /**
     * @uses \Fury\Http\SupportedRequestMethods
     */
    public function testGetAllowedRequestMethods(): void
    {
        $pathMock = $this->createMock(UriPath::class);
        $cookiesMock = $this->createMock(RequestCookieJar::class);

        $request = $this->getMockForAbstractClass(Request::class, [$pathMock, $cookiesMock]);
        $expected = new SupportedRequestMethods('HEAD', 'GET', 'POST');
        $this->assertEquals($expected, $request->getSupportedRequestMethods());
    }

    /**
     * @return MockObject|Request
     */
    private function getRequest()
    {
        return $this->getMockForAbstractClass(Request::class, [$this->path, $this->cookieJar]);
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

    /**
     * @return MockObject|RequestCookie
     */
    private function getRequestCookieMock()
    {
        return $this->createMock(RequestCookie::class);
    }
}
