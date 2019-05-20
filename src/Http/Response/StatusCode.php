<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Response;

interface StatusCode
{
    public function asInt(): int;
}
