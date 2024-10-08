<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Result\Result;
use Kartenmacherei\HttpFramework\Http\Result\ResultRenderer;

abstract class ResultRoute
{
    /** @var ResultRoute */
    private $nextRoute;

    /** @param ResultRoute $route */
    public function setNextRoute(ResultRoute $route): void
    {
        $this->nextRoute = $route;
    }

    /**
     * @param Result $result
     *
     * @return ResultRenderer
     */
    public function route(Result $result): ResultRenderer
    {
        if ($this->canRoute($result) === false) {
            return $this->tryNext($result);
        }

        return $this->getResultRenderer($result);
    }

    /**
     * @param Result $result
     *
     * @return bool
     */
    abstract protected function canRoute(Result $result): bool;

    /**
     * @param Result $result
     *
     * @return ResultRenderer
     */
    abstract protected function getResultRenderer(Result $result): ResultRenderer;

    /**
     * @param Result $result
     *
     * @throws NoNextRouteException
     *
     * @return ResultRenderer
     */
    private function tryNext(Result $result): ResultRenderer
    {
        if ($this->nextRoute === null) {
            throw new NoNextRouteException();
        }

        return $this->nextRoute->route($result);
    }
}
