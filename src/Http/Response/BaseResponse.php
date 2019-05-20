<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Response;

abstract class BaseResponse implements Response
{
    /**
     * @var ResponseCookie[]
     */
    private $cookies = [];

    public function addCookie(ResponseCookie $cookie): void
    {
        $this->cookies[] = $cookie;
    }

    public function send(): void
    {
        http_response_code($this->getStatusCode()->asInt());

        foreach ($this->cookies as $cookie) {
            $cookie->send();
        }

        $this->flush();
    }

    /**
     * @return StatusCode
     */
    abstract protected function getStatusCode(): StatusCode;

    abstract protected function flush(): void;
}
