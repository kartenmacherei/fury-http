<?php

declare(strict_types=1);
namespace Fury\Http;

class GetRequest extends Request
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @param UriPath $path
     * @param array $parameters
     */
    public function __construct(UriPath $path, array $parameters)
    {
        parent::__construct($path);
        $this->parameters = $parameters;
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
     * @return bool
     */
    public function hasParameters(): bool
    {
        return count($this->parameters) > 0;
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

    /**
     * @return bool
     */
    public function isGetRequest(): bool
    {
        return true;
    }
}
