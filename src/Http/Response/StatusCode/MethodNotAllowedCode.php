<?php

declare(strict_types=1);
namespace Fury\Http\Response\StatusCode;

use Fury\Http\Response\StatusCode;

class MethodNotAllowedCode implements StatusCode
{
    public function asInt(): int
    {
        return 405;
    }
}
