<?php

declare(strict_types=1);
namespace Fury\Http;

class PostRequest extends Request
{
    /**
     * @var Body
     */
    private $body;

    public function __construct(UriPath $path, Body $body)
    {
        parent::__construct($path);
        $this->body = $body;
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function isPostRequest(): bool
    {
        return true;
    }
}
