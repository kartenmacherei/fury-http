<?php

declare(strict_types=1);
namespace Fury\Http;

class GetRouter
{
    /**
     * @var GetRoute
     */
    private $firstRoute;

    /**
     * @var GetRoute
     */
    private $lastRoute;

    public function route(GetRequest $request): Query
    {
        return $this->firstRoute->route($request);
    }

    /**
     * @param GetRoute $route
     */
    public function addRoute(GetRoute $route)
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
