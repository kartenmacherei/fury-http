<?php declare(strict_types=1);
namespace Fury\Http;

use Fury\Http\StatusCode\StatusCode;

abstract class BaseResponse implements Response
{
    public function send()
    {
        http_response_code($this->getStatusCode()->asInt());

        $this->flush();
    }

    /**
     * @return StatusCode
     */
    abstract protected function getStatusCode(): StatusCode;

    abstract protected function flush();
}
