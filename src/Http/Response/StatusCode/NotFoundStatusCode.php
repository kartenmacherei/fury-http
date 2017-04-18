<?php declare(strict_types=1);
namespace Fury\Http\StatusCode;

class NotFoundStatusCode implements StatusCode
{
    public function asInt(): int
    {
        return 404;
    }
}
