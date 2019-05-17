<?php

declare(strict_types=1);
namespace Fury\Application\Routing;

use Fury\Application\Result\NotFoundResult;
use Fury\Application\Result\NotFoundResultRenderer;
use Fury\Http\Result\Result;
use Fury\Http\Result\ResultRenderer;
use Fury\Http\Routing\ResultRoute;

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
