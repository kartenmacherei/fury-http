<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Result;
use Fury\Http\ResultRenderer;
use Fury\Http\ResultRoute;

class NotFoundResultRoute extends ResultRoute
{
    protected function canRoute(Result $result): bool
    {
        return $result instanceof NotFoundResult;
    }

    protected function getResultRenderer(Result $result): ResultRenderer
    {
        /* @var NotFoundResult $result */
        return new NotFoundResultRenderer($result);
    }
}
