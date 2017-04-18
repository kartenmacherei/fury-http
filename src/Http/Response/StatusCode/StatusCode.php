<?php declare(strict_types=1);
namespace Fury\Http\StatusCode;

interface StatusCode
{
    public function asInt(): int;
}
