<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Application\Content\ContentType;
use Fury\Http\Request\FormPostRequest;
use Fury\Http\Request\GetRequest;
use Fury\Http\Request\JsonPostRequest;
use Fury\Http\Request\RawPostRequest;
use Fury\Http\Request\Request;
use Fury\Http\Request\RequestCookie;
use Fury\Http\Request\RequestCookieJar;
use Fury\Http\Request\SupportedRequestMethods;
use Fury\Http\Request\UnsupportedRequestMethodException;
use Fury\Http\Request\UriPath;
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

    protected function setUp(): void
    {
        $this->path = $this->getUriPathMock();
        $this->cookieJar = $this->getRequestCookieJarMock();

        $this->request = $this->getRequest();

        $this->vfs = vfsStream::setup();
    }

    public function testIsGetRequestReturnsFalse(): void
    {
        $this->assertFalse($this->request->isGetRequest());
    }

    public function testIsPostRequestReturnsFalse(): void
    {
        $this->assertFalse($this->request->isPostRequest());
    }

    public function testGetPathReturnsExpectedObject(): void
    {
        $this->assertSame($this->path, $this->request->getPath());
    }

    public function testHasCookieReturnsExpectedValue(): void
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

    public function testGetCookieValueReturnsExpectedString(): void
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
     * @throws \Fury\Http\Request\UnsupportedRequestMethodException
     */
    public function testCreatesExpectedFormPostRequest(string $contentType, string $inputStream, string $expectedClass): void
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
    public function testCreatesExpectedGetRequest(): void
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
    public function testThrowsExceptionIfRequestMethodIsNotSupported(): void
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
