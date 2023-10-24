<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Response\StatusCode;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode;

class NotFoundStatusCode implements StatusCode
{
    public function asInt(): int
    {
        return 404;
    }
}
