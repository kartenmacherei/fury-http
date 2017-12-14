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
    private $cookies;

    /**
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @param ResponseCookie $cookie
     */
    public function addCookie(ResponseCookie $cookie)
    {
        $this->cookies[] = $cookie;
    }

    /**
     * @return StatusCode
     */
    protected function getStatusCode(): StatusCode
    {
        return new OkStatusCode();
    }

    protected function flush()
    {
        foreach ($this->cookies as $cookie) {
            $cookie->send();
        }

        header(sprintf(
            'Content-Type: %s; charset=UTF-8',
            $this->content->getContentType()->asString()
        ));
        echo $this->content->asString();
    }
}
