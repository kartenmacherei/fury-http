<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\PutRequest;

class PutRouter
{
    private ?PutRoute $firstRoute = null;

    private ?PutRoute $lastRoute = null;

    public function route(PutRequest $request): Command
    {
        if ($this->firstRoute === null) {
            throw new NoRoutesException();
        }

        return $this->firstRoute->route($request);
    }

    public function addRoute(PutRoute $route): void
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
