<?php

declare(strict_types=1);
namespace Fury\Http;

class RedirectStatusCode implements StatusCode
{
    public function asInt(): int
    {
        return 302;
    }
}
