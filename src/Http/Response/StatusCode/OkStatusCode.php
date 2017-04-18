<?php

declare(strict_types=1);
namespace Fury\Http;

class OkStatusCode implements StatusCode
{
    public function asInt(): int
    {
        return 200;
    }
}
