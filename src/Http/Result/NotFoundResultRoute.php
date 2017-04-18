<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\ResultRoute;

class NotFoundResultRoute extends ResultRoute
{
    protected function canRoute(Result $result): bool
    {
        return $result instanceof NotFoundResult;
    }

    protected function getResultRenderer(Result $result): ResultRenderer
    {
        return new NotFoundResultRenderer();
    }

}
