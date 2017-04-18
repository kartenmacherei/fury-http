<?php

declare(strict_types=1);
namespace Fury\Http;

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
