<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Request;

use Kartenmacherei\HttpFramework\Application\Content\ContentType;
use Kartenmacherei\HttpFramework\Http\Request\Body\JsonBody;
use Kartenmacherei\HttpFramework\Http\Request\Body\RawBody;

abstract class Request
{
    private const METHOD_HEAD = 'HEAD';
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';
    private const METHOD_DELETE = 'DELETE';

    /** @var UriPath */
    private $path;

    /** @var RequestCookieJar */
    private $cookies;

    /** @var array */
    private $server;

    /**
     * @param array $server
     * @param UriPath $path
     * @param RequestCookieJar $cookies
     */
    public function __construct(array $server, UriPath $path, RequestCookieJar $cookies)
    {
        $this->server = $server;
        $this->path = $path;
        $this->cookies = $cookies;
    }

    /**
     * @param string $inputStream
     *
     * @return GetRequest|PostRequest|Request
     */
    public static function fromSuperGlobals(string $inputStream = 'php://input'): Request
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $uriPath = new UriPath($_SERVER['REQUEST_URI']);

        switch ($method) {
            case self::METHOD_HEAD:
            case self::METHOD_GET:
                return new GetRequest($uriPath, RequestCookieJar::fromSuperGlobals(), $_GET, $_SERVER);
            case self::METHOD_POST:
                return self::createPostRequest($uriPath, $inputStream);
            case self::METHOD_DELETE:
                return self::createDeleteRequest($uriPath);
            default:
                $message = sprintf('Can not handle method "%s"', $_SERVER['REQUEST_METHOD']);
                throw new UnsupportedRequestMethodException($message);
        }
    }

    public function isDeleteRequest(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isGetRequest(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPostRequest(): bool
    {
        return false;
    }

    /**
     * @return UriPath
     */
    public function getPath(): UriPath
    {
        return $this->path;
    }

    public function hasCookie($name): bool
    {
        return $this->cookies->hasCookie($name);
    }

    public function getCookieValue($name): string
    {
        return $this->cookies->getCookie($name)->getValue();
    }

    public function getSupportedRequestMethods(): SupportedRequestMethods
    {
        return new SupportedRequestMethods(
            self::METHOD_HEAD,
            self::METHOD_GET,
            self::METHOD_POST
        );
    }

    public function hasHeader(string $name): bool
    {
        return array_key_exists($this->normalizeHttpHeaderName($name), $this->server);
    }

    public function getHeader(string $name): string
    {
        if (!$this->hasHeader($name)) {
            throw new HeaderNotFoundException(sprintf('Header %s not found in Request', $name));
        }

        return (string) $this->server[$this->normalizeHttpHeaderName($name)];
    }

    private function normalizeHttpHeaderName(string $name): string
    {
        $name = strtoupper($name);
        $name = str_replace('-', '_', $name);

        return 'HTTP_' . $name;
    }

    private static function createPostRequest(UriPath $path, string $inputStream): PostRequest
    {
        $content = file_get_contents($inputStream);
        $cookieJar = RequestCookieJar::fromSuperGlobals();

        switch ($_SERVER['CONTENT_TYPE']) {
            case '':
                return new RawPostRequest($path, $cookieJar, new RawBody($content), $_SERVER);
            case ContentType::JSON:
            case ContentType::JSON_UTF8:
                return new JsonPostRequest($path, $cookieJar, new JsonBody($content), $_SERVER);
            case ContentType::WWW_FORM:
            case ContentType::WWW_FORM_UTF8:
                return new FormPostRequest($path, $cookieJar, $_POST, $_SERVER);
        }

        return new RawPostRequest($path, $cookieJar, new RawBody($content), $_SERVER);
    }

    private static function createDeleteRequest(UriPath $path): DeleteRequest
    {
        return new DeleteRequest($_SERVER, $path, RequestCookieJar::fromSuperGlobals());
    }
}
