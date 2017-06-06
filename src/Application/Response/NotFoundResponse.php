<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\NotFoundStatusCode;
use Fury\Http\StatusCode;

class NotFoundResponse extends ContentResponse
{
    protected function getStatusCode(): StatusCode
    {
        return new NotFoundStatusCode();
    }
}
