<?php

declare(strict_types=1);
namespace Fury\Http;

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
     * @throws UnsupportedRequestMethodException
     *
     * @return GetRequest|PostRequest|Request
     */
    public static function fromSuperGlobals(): Request
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $uriPath = new UriPath($_SERVER['DOCUMENT_URI']);

        $body = Body::fromSuperGlobals();

        switch ($method) {
            case 'HEAD':
            case 'GET':
                return new GetRequest(
                    $uriPath,
                    RequestCookieJar::fromSuperGlobals(),
                    $_GET
                );
            case 'POST':
                return new PostRequest(
                    $uriPath,
                    RequestCookieJar::fromSuperGlobals(),
                    $body
                );
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
}
