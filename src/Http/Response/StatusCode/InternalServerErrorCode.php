<?php

declare(strict_types=1);
namespace Fury\Http;

class InternalServerErrorCode implements StatusCode
{
    public function asInt(): int
    {
        return 500;
    }
}
