<?php declare(strict_types=1);
namespace Frontend\Http\StatusCode;

class OkStatusCode implements StatusCode
{
    public function asInt(): int
    {
        return 200;
    }
}
