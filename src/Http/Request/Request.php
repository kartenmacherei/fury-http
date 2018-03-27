<?php

declare(strict_types=1);
namespace Fury\Http;

use Fury\Application\ContentType;

abstract class Request
{
    /**
     * @var UriPath
     */
    private $path;

    /**
     * @var RequestCookieJar
     */
    private $cookies;

    /**
     * @param UriPath $path
     * @param RequestCookieJar $cookies
     */
    public function __construct(UriPath $path, RequestCookieJar $cookies)
    {
        $this->path = $path;
        $this->cookies = $cookies;
    }

    /**
     * @param string $inputStream
     *
     * @throws UnsupportedRequestMethodException
     *
     * @return GetRequest|PostRequest|Request
     */
    public static function fromSuperGlobals(string $inputStream = 'php://input'): Request
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $uriPath = new UriPath($_SERVER['DOCUMENT_URI']);

        switch ($method) {
            case 'HEAD':
            case 'GET':
                return new GetRequest($uriPath, RequestCookieJar::fromSuperGlobals(), $_GET);
            case 'POST':
                return self::createPostRequest($uriPath, $inputStream);
            default:
                $message = sprintf('Can not handle method "%s"', $_SERVER['REQUEST_METHOD']);
                throw new UnsupportedRequestMethodException($message);
        }
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

    private static function createPostRequest(UriPath $path, string $inputStream): PostRequest
    {
        $content = file_get_contents($inputStream);
        $cookieJar = RequestCookieJar::fromSuperGlobals();

        switch ($_SERVER['CONTENT_TYPE']) {
            case '':
                return new RawPostRequest($path, $cookieJar, new RawBody($content));
            case ContentType::JSON:
            case ContentType::JSON_UTF8:
                return new JsonPostRequest($path, $cookieJar, new JsonBody($content));
            case ContentType::WWW_FORM:
            case ContentType::WWW_FORM_UTF8:
                return new FormPostRequest($path, $cookieJar, $_POST);
        }

        return new RawPostRequest($path, $cookieJar, new RawBody($content));
    }
}
