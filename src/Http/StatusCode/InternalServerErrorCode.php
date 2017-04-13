<?php declare(strict_types=1);
namespace Frontend\Http\StatusCode;

class InternalServerErrorCode implements StatusCode
{
    public function asInt(): int
    {
        return 500;
    }
}
