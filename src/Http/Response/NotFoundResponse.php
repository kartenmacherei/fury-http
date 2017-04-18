<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\BaseResponse;
use Fury\Http\StatusCode\NotFoundStatusCode;
use Fury\Http\StatusCode\StatusCode;

class NotFoundResponse extends BaseResponse
{
    protected function getStatusCode(): StatusCode
    {
        return new NotFoundStatusCode();
    }

    protected function flush()
    {

    }
}
