<?php declare(strict_types=1);
namespace Frontend\Http;

use Frontend\Result;
use Frontend\ResultRenderer;

abstract class ResultRoute
{
    /**
     * @var ResultRoute
     */
    private $nextRoute;

    /**
     * @param ResultRoute $route
     */
    public function setNextRoute(ResultRoute $route)
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
        if($this->canRoute($result) === false)
        {
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
     * @return ResultRenderer
     *
     * @throws NoNextRouteException
     */
    private function tryNext(Result $result): ResultRenderer
    {
        if($this->nextRoute === null)
        {
            throw new NoNextRouteException();
        }

        return $this->nextRoute->route($result);
    }
}
