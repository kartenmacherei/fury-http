<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Response\StatusCode;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode;

class MethodNotAllowedCode implements StatusCode
{
    public function asInt(): int
    {
        return 405;
    }
}
