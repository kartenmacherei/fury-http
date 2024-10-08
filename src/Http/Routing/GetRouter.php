<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Query;
use Kartenmacherei\HttpFramework\Http\Request\GetRequest;

class GetRouter
{
    /** @var GetRoute */
    private $firstRoute;

    /** @var GetRoute */
    private $lastRoute;

    public function route(GetRequest $request): Query
    {
        if ($this->firstRoute === null) {
            throw new NoRoutesException();
        }

        return $this->firstRoute->route($request);
    }

    /** @param GetRoute $route */
    public function addRoute(GetRoute $route): void
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
