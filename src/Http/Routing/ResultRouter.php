<?php

declare(strict_types=1);
namespace Fury\Http;

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
     * @throws NoRoutesException
     *
     * @return ResultRenderer
     */
    public function route(Result $result): ResultRenderer
    {
        if ($this->firstRoute === null) {
            throw new NoRoutesException();
        }

        return $this->firstRoute->route($result);
    }

    /**
     * @param ResultRoute $route
     */
    public function addRoute(ResultRoute $route): void
    {
        if ($this->firstRoute === null) {
            $this->firstRoute = $route;
        }

        if ($this->lastRoute !== null) {
            $this->lastRoute->setNextRoute($route);
        }

        $this->lastRoute = $route;
    }
}
