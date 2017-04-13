<?php declare(strict_types=1);
namespace Frontend\Http\StatusCode;

interface StatusCode
{
    public function asInt(): int;
}
