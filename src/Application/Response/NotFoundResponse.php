<?php

declare(strict_types=1);
namespace Fury\Application\Response;

use Fury\Http\Response\StatusCode;
use Fury\Http\Response\StatusCode\NotFoundStatusCode;

class NotFoundResponse extends ContentResponse
{
    protected function getStatusCode(): StatusCode
    {
        return new NotFoundStatusCode();
    }
}
