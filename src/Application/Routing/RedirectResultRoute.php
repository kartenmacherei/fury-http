<?php

declare(strict_types=1);
namespace Fury\Application\Routing;

use Fury\Application\Result\RedirectRenderer;
use Fury\Application\Result\RedirectResult;
use Fury\Http\Result\Result;
use Fury\Http\Result\ResultRenderer;
use Fury\Http\Routing\ResultRoute;

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
