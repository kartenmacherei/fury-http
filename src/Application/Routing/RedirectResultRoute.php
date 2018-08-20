<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Result;
use Fury\Http\ResultRenderer;
use Fury\Http\ResultRoute;

class RedirectResultRoute extends ResultRoute
{
    /**
     * @param Result $result
     *
     * @return bool
     */
    protected function canRoute(Result $result): bool
    {
        return $result instanceof RedirectResult;
    }

    /**
     * @param Result $result
     *
     * @return ResultRenderer
     */
    protected function getResultRenderer(Result $result): ResultRenderer
    {
        /* @var RedirectResult $result */
        return new RedirectRenderer($result);
    }
}
