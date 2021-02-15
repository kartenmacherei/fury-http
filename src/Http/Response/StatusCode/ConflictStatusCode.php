<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Response\StatusCode;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode;

class ConflictStatusCode implements StatusCode
{
    public function asInt(): int
    {
        return 409;
    }
}
