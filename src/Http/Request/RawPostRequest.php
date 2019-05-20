<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Request;

use Kartenmacherei\HttpFramework\Http\Request\Body\RawBody;

class RawPostRequest extends PostRequest
{
    /**
     * @var RawBody
     */
    private $body;

    public function __construct(UriPath $path, RequestCookieJar $cookies, RawBody $body)
    {
        parent::__construct($path, $cookies);
        $this->body = $body;
    }

    public function hasBody(): bool
    {
        return true;
    }

    public function getBody(): string
    {
        return $this->body->getContent();
    }
}
