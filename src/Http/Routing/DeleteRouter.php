<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;

class DeleteRouter
{
    private ?DeleteRoute $firstRoute = null;

    private ?DeleteRoute $lastRoute = null;

    public function route(DeleteRequest $request): Command
    {
        if ($this->firstRoute === null) {
            throw new NoRoutesException();
        }

        return $this->firstRoute->route($request);
    }

    /**
     * @param DeleteRoute $route
     */
    public function addRoute(DeleteRoute $route): void
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
