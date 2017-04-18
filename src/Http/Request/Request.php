<?php declare(strict_types=1);
namespace Fury\Http;

abstract class Request
{
    /**
     * @var UriPath
     */
    private $path;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @param UriPath $path
     * @param array $parameters
     */
    public function __construct(
        UriPath $path,
        array $parameters
    ) {
        $this->path = $path;
        $this->parameters = $parameters;
    }

    /**
     * @return Request
     *
     * @throws UnsupportedRequestMethodException
     */
    public static function fromSuperGlobals(): Request
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'HEAD':
            case 'GET':
                return new GetRequest(
                    new UriPath($_SERVER['DOCUMENT_URI']),
                    $_GET
                );
            case 'POST':
                return new PostRequest(
                    new UriPath($_SERVER['DOCUMENT_URI']),
                    $_POST
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

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasParameter(string $key): bool
    {
        return isset($this->parameters[$key]);
    }

    /**
     * @param string $key
     *
     * @throws RequestParameterNotFoundException
     *
     * @return string
     */
    public function getParameter(string $key): string
    {
        if (!$this->hasParameter($key)) {
            $message = sprintf('Request does not contain parameter "%s".', $key);
            throw new RequestParameterNotFoundException($message);
        }

        return $this->parameters[$key];
    }
}
