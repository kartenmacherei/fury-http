<?php

declare(strict_types=1);
namespace Fury\Http;

class EmptyBody extends Body
{
    public function isJson(): bool
    {
        return false;
    }
}
