<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Request;

use Kartenmacherei\HttpFramework\Http\Request\Body\JsonBody;

class JsonPutRequest extends PutRequest
{
    /** @var JsonBody */
    private $body;

    public function __construct(UriPath $path, RequestCookieJar $cookies, JsonBody $body, array $server)
    {
        parent::__construct($server, $path, $cookies);
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
