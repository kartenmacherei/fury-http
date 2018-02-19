<?php

declare(strict_types=1);
namespace Fury\Http;

class JsonPostRequest extends PostRequest
{
    /**
     * @var JsonBody
     */
    private $body;

    public function __construct(UriPath $path, RequestCookieJar $cookies, JsonBody $body)
    {
        parent::__construct($path, $cookies);
        $this->body = $body;
    }

    public function hasBody(): bool
    {
        return true;
    }

    public function getBody(): JsonBody
    {
        return $this->body;
    }
}
