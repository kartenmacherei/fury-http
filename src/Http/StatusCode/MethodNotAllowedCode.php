<?php declare(strict_types=1);
namespace Frontend\Http\StatusCode;

class MethodNotAllowedCode implements StatusCode
{
    public function asInt(): int
    {
        return 405;
    }
}
