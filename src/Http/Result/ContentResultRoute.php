<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\ResultRoute;

class ContentResultRoute extends ResultRoute
{
    /**
     * @param Result $result
     * @return bool
     */
    protected function canRoute(Result $result): bool
    {
        return $result instanceof ContentResult;
    }

    /**
     * @param Result $result
     * @return ResultRenderer
     */
    protected function getResultRenderer(Result $result): ResultRenderer
    {
        /** @var ContentResult $result */
        return new ContentResultRenderer($result);
    }

}
