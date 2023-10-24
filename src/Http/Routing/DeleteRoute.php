<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;

abstract class DeleteRoute
{
    private ?DeleteRoute $nextRoute = null;

    public function setNextRoute(DeleteRoute $route): void
    {
        $this->nextRoute = $route;
    }

    public function route(DeleteRequest $request): Command
    {
        if ($this->canRoute($request) === false) {
            return $this->tryNext($request);
        }

        return $this->getCommand($request);
    }

    abstract protected function canRoute(DeleteRequest $request): bool;

    abstract protected function getCommand(DeleteRequest $request): Command;

    /**
     * @param DeleteRequest $request
     *
     * @throws NoNextRouteException
     *
     * @return Command
     */
    private function tryNext(DeleteRequest $request): Command
    {
        if ($this->nextRoute === null) {
            throw new NoNextRouteException();
        }

        return $this->nextRoute->route($request);
    }
}
