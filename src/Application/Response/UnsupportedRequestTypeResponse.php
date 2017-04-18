<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\BaseResponse;
use Fury\Http\MethodNotAllowedCode;
use Fury\Http\StatusCode;

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
