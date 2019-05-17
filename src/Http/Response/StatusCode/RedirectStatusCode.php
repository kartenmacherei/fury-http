<?php

declare(strict_types=1);
namespace Fury\Http\Response\StatusCode;

use Fury\Http\Response\StatusCode;

class RedirectStatusCode implements StatusCode
{
    public function asInt(): int
    {
        return 302;
    }
}
