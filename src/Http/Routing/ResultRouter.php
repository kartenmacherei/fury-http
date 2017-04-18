<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\ResultRoute;

class ResultRouter
{
    /**
     * @var ResultRoute
     */
    private $firstRoute;

    /**
     * @var ResultRoute
     */
    private $lastRoute;

    /**
     * @param Result $result
     *
     * @return ResultRenderer
     */
    public function route(Result $result): ResultRenderer
    {
        return $this->firstRoute->route($result);
    }

    /**
     * @param ResultRoute $route
     */
    public function addRoute(ResultRoute $route)
    {
        if($this->firstRoute === null)
        {
            $this->firstRoute = $route;
        }

        if($this->lastRoute !== null)
        {
            $this->lastRoute->setNextRoute($route);
        }

        $this->lastRoute = $route;
    }
}
