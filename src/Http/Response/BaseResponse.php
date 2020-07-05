<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Response;

abstract class BaseResponse implements Response
{
    /**
     * @var ResponseCookie[]
     */
    private $cookies = [];

    /**
     * @var array
     */
    private $headers = [];

    public function addCookie(ResponseCookie $cookie): void
    {
        $this->cookies[] = $cookie;
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    public function send(): void
    {
        http_response_code($this->getStatusCode()->asInt());

        foreach ($this->cookies as $cookie) {
            $cookie->send();
        }

        foreach ($this->headers as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }

        $this->flush();
    }

    /**
     * @return StatusCode
     */
    abstract protected function getStatusCode(): StatusCode;

    abstract protected function flush(): void;
}
