<?php

declare(strict_types=1);
namespace Fury\Http;

class FormPostRequest extends PostRequest
{
    private $parameters = [];

    public function __construct(UriPath $path, RequestCookieJar $cookies, array $parameters)
    {
        parent::__construct($path, $cookies);
        $this->parameters = $parameters;
    }

    public function hasParameter(string $key): bool
    {
        return isset($this->parameters[$key]);
    }

    public function hasParameters(): bool
    {
        return true;
    }

    public function getParameter(string $key): string
    {
        if (!$this->hasParameter($key)) {
            $message = sprintf('Request does not contain parameter "%s".', $key);
            throw new RequestParameterNotFoundException($message);
        }

        return $this->parameters[$key];
    }
}
