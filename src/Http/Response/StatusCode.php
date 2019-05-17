<?php

declare(strict_types=1);
namespace Fury\Http\Response;

interface StatusCode
{
    public function asInt(): int;
}
