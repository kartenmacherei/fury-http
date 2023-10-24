<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\PostRequest;

class PostRouter
{
    /** @var PostRoute */
    private $firstRoute;

    /** @var PostRoute */
    private $lastRoute;

    public function route(PostRequest $request): Command
    {
        if ($this->firstRoute === null) {
            throw new NoRoutesException();
        }

        return $this->firstRoute->route($request);
    }

    public function addRoute(PostRoute $route): void
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
