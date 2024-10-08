<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Response;

use Kartenmacherei\HttpFramework\Http\Response\StatusCode;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode\BadRequestStatusCode;

class BadRequestResponse extends ContentResponse
{
    protected function getStatusCode(): StatusCode
    {
        return new BadRequestStatusCode();
    }
}
