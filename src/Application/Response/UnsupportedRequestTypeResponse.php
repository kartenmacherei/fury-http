<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\BaseResponse;
use Fury\Http\MethodNotAllowedCode;
use Fury\Http\ResponseCookie;
use Fury\Http\StatusCode;

class UnsupportedRequestTypeResponse extends BaseResponse
{
    protected function getStatusCode(): StatusCode
    {
        return new MethodNotAllowedCode();
    }

    protected function flush(): void
    {
        echo 'Method Not Allowed';
    }

    public function addCookie(ResponseCookie $cookie): void
    {
        echo 'Method Not Allowed';
    }
}
