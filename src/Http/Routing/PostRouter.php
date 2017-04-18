<?php

declare(strict_types=1);
namespace Fury\Http;

class PostRouter
{
    /**
     * @var PostRoute
     */
    private $firstRoute;

    /**
     * @var PostRoute
     */
    private $lastRoute;

    public function route(PostRequest $request): Command
    {
        return $this->firstRoute->route($request);
    }

    public function addRoute(PostRoute $route)
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
