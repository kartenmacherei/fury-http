<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Application\Content\ContentType;
use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;
use Kartenmacherei\HttpFramework\Http\Request\FormPostRequest;
use Kartenmacherei\HttpFramework\Http\Request\GetRequest;
use Kartenmacherei\HttpFramework\Http\Request\HeaderNotFoundException;
use Kartenmacherei\HttpFramework\Http\Request\JsonPostRequest;
use Kartenmacherei\HttpFramework\Http\Request\JsonPutRequest;
use Kartenmacherei\HttpFramework\Http\Request\RawPostRequest;
use Kartenmacherei\HttpFramework\Http\Request\RawPutRequest;
use Kartenmacherei\HttpFramework\Http\Request\Request;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookie;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookieJar;
use Kartenmacherei\HttpFramework\Http\Request\SupportedRequestMethods;
use Kartenmacherei\HttpFramework\Http\Request\UnsupportedRequestMethodException;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\Request
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\GetRequest
 * @uses \Kartenmacherei\HttpFramework\Http\Request\UriPath
 * @uses \Kartenmacherei\HttpFramework\Http\Url
 */
class RequestTest extends TestCase
{
    /** @var Request */
    private $request;

    /** @var MockObject|UriPath */
    private $path;

    /** @var MockObject|RequestCookieJar */
    private $cookieJar;

    /** @var vfsStreamDirectory */
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

    public function testIsDeleteRequestReturnsFalse(): void
    {
        $this->assertFalse($this->request->isDeleteRequest());
    }

    public function testIsPutRequestReturnsFalse(): void
    {
        $this->assertFalse($this->request->isPutRequest());
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
     * @throws \Kartenmacherei\HttpFramework\Http\Request\UnsupportedRequestMethodException
     */
    public function testCreatesExpectedFormPostRequest(string $contentType, string $inputStream, string $expectedClass): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/foo';
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
     *
     * @dataProvider putRequestTestDataProvider
     *
     * @param string $contentType
     * @param string $inputStream
     * @param string $expectedClass
     *
     * @throws \Kartenmacherei\HttpFramework\Http\Request\UnsupportedRequestMethodException
     */
    public function testCreatesExpectedFormPutRequest(string $contentType, string $inputStream, string $expectedClass): void
    {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['REQUEST_URI'] = '/foo';
        $_SERVER['CONTENT_TYPE'] = $contentType;

        file_put_contents($this->vfs->url() . '/input', $inputStream);

        $this->assertInstanceOf($expectedClass, Request::fromSuperGlobals($this->vfs->url() . '/input'));
    }

    public function putRequestTestDataProvider()
    {
        return [
            [ContentType::JSON, '{"foo":"bar"}', JsonPutRequest::class],
            [ContentType::JSON_UTF8, '{"foo":"bar"}', JsonPutRequest::class],
            ['', '', RawPutRequest::class],
            ['foo', '', RawPutRequest::class],
        ];
    }

    public function useOnlyPathOfUriProvider(): array
    {
        return [
            'GET is equal to params' => ['/foo?foo=bar', ['foo' => 'bar']],
            'GET is not equal to params' => ['/foo?ignore=me', ['foo' => 'bar']],
        ];
    }

    /**
     * @runInSeparateProcess
     *
     * @dataProvider useOnlyPathOfUriProvider
     *
     * @param string $requestUri
     * @param array $getParameter
     *
     * @throws UnsupportedRequestMethodException
     */
    public function testUseOnlyPathOfUri(string $requestUri, array $getParameter): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = $requestUri;
        $_GET = $getParameter;

        $expected = new GetRequest(new UriPath('/foo'), new RequestCookieJar(), $_GET, $_SERVER);
        $this->assertEquals($expected, Request::fromSuperGlobals());
    }

    /** @runInSeparateProcess */
    public function testCreatesExpectedGetRequest(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/foo';
        $_GET = ['foo' => 'bar'];

        $expected = new GetRequest(new UriPath('/foo'), new RequestCookieJar(), $_GET, $_SERVER);
        $this->assertEquals($expected, Request::fromSuperGlobals());
    }

    /** @runInSeparateProcess */
    public function testThrowsExceptionIfRequestMethodIsNotSupported(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'FOO';
        $_SERVER['REQUEST_URI'] = '/foo';
        $this->expectException(UnsupportedRequestMethodException::class);

        Request::fromSuperGlobals();
    }

    /** @uses \Kartenmacherei\HttpFramework\Http\Request\SupportedRequestMethods */
    public function testGetAllowedRequestMethods(): void
    {
        $pathMock = $this->createMock(UriPath::class);
        $cookiesMock = $this->createMock(RequestCookieJar::class);

        $request = $this->getMockForAbstractClass(Request::class, [[], $pathMock, $cookiesMock]);
        $expected = new SupportedRequestMethods('HEAD', 'GET', 'POST', 'PUT', 'DELETE');
        $this->assertEquals($expected, $request->getSupportedRequestMethods());
    }

    public function testHasExpectedHeader(): void
    {
        $pathMock = $this->createMock(UriPath::class);
        $cookiesMock = $this->createMock(RequestCookieJar::class);
        $server = [
            'HTTP_CONTENT_TYPE' => 'foo',
        ];

        $request = $this->getMockForAbstractClass(Request::class, [$server, $pathMock, $cookiesMock]);
        $this->assertFalse($request->hasHeader('Accept'));
        $this->assertTrue($request->hasHeader('Content-Type'));
        $this->assertTrue($request->hasHeader('Content_Type'));
        $this->assertTrue($request->hasHeader('CONTENT_TYPE'));
        $this->assertTrue($request->hasHeader('content-type'));
    }

    public function testThrowsExceptionIfHeaderIsNotSet(): void
    {
        $pathMock = $this->createMock(UriPath::class);
        $cookiesMock = $this->createMock(RequestCookieJar::class);

        $request = $this->getMockForAbstractClass(Request::class, [[], $pathMock, $cookiesMock]);
        $this->expectException(HeaderNotFoundException::class);
        $request->getHeader('foo');
    }

    public function testReturnsExpectedHeaderValue(): void
    {
        $pathMock = $this->createMock(UriPath::class);
        $cookiesMock = $this->createMock(RequestCookieJar::class);
        $server = [
            'HTTP_CONTENT_TYPE' => 'application/json',
        ];

        $request = $this->getMockForAbstractClass(Request::class, [$server, $pathMock, $cookiesMock]);
        $this->assertSame('application/json', $request->getHeader('Content-Type'));
    }

    /** @runInSeparateProcess */
    public function testCreatesExpectedDeleteRequest(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/foo';
        $request = Request::fromSuperGlobals();
        $this->assertInstanceOf(DeleteRequest::class, $request);
    }

    /** @return MockObject|Request */
    private function getRequest()
    {
        return $this->getMockForAbstractClass(Request::class, [[], $this->path, $this->cookieJar]);
    }

    /** @return MockObject|RequestCookieJar */
    private function getRequestCookieJarMock()
    {
        return $this->createMock(RequestCookieJar::class);
    }

    /** @return MockObject|UriPath */
    private function getUriPathMock()
    {
        return $this->createMock(UriPath::class);
    }

    /** @return MockObject|RequestCookie */
    private function getRequestCookieMock()
    {
        return $this->createMock(RequestCookie::class);
    }
}
