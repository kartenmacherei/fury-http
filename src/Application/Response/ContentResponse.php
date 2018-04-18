<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\BaseResponse;
use Fury\Http\OkStatusCode;
use Fury\Http\ResponseCookie;
use Fury\Http\StatusCode;

class ContentResponse extends BaseResponse
{
    /**
     * @var Content
     */
    private $content;

    /**
     * @var ResponseCookie[]
     */
    private $cookies = [];

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function addCookie(ResponseCookie $cookie): void
    {
        $this->cookies[] = $cookie;
    }

    protected function getStatusCode(): StatusCode
    {
        return new OkStatusCode();
    }

    protected function getContent(): Content
    {
        return $this->content;
    }

    protected function flush(): void
    {
        foreach ($this->cookies as $cookie) {
            $cookie->send();
        }

        $content = $this->getContent();
        header(sprintf(
            'Content-Type: %s; charset=UTF-8',
            $content->getContentType()->asString()
        ));
        echo $content->asString();
    }
}
