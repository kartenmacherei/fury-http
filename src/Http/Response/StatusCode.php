<?php

declare(strict_types=1);
namespace Fury\Http;

interface StatusCode
{
    public function asInt(): int;
}
