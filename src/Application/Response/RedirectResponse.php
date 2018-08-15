<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\RedirectStatusCode;
use Fury\Http\StatusCode;

class RedirectResponse extends ContentResponse
{
    public function getStatusCode(): StatusCode
    {
        return new RedirectStatusCode();
    }
}
