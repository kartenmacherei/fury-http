<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Routing;

use Kartenmacherei\HttpFramework\Application\Result\RedirectRenderer;
use Kartenmacherei\HttpFramework\Application\Result\RedirectResult;
use Kartenmacherei\HttpFramework\Http\Result\Result;
use Kartenmacherei\HttpFramework\Http\Result\ResultRenderer;
use Kartenmacherei\HttpFramework\Http\Routing\ResultRoute;

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
