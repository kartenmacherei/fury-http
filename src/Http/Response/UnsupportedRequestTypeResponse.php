<?php

declare(strict_types=1);
namespace Fury\Http;

class UnsupportedRequestTypeResponse extends BaseResponse
{
    /**
     * @return StatusCode
     */
    public function getStatusCode(): StatusCode
    {
        return new MethodNotAllowedCode();
    }

    protected function flush()
    {
        echo 'Method Not Allowed';
    }
}
