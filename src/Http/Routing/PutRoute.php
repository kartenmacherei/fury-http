<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\PutRequest;

abstract class PutRoute
{
    /** @var PutRoute */
    private $nextRoute;

    /**
     * @param PutRoute $route
     */
    public function setNextRoute(PutRoute $route): void
    {
        $this->nextRoute = $route;
    }

    /**
     * @param PutRequest $request
     *
     * @return Command
     */
    public function route(PutRequest $request): Command
    {
        if ($this->canRoute($request) === false) {
            return $this->tryNext($request);
        }

        return $this->getCommand($request);
    }

    /**
     * @param PutRequest $request
     *
     * @return bool
     */
    abstract protected function canRoute(PutRequest $request): bool;

    /**
     * @param PutRequest $request
     *
     * @return Command
     */
    abstract protected function getCommand(PutRequest $request): Command;

    /**
     * @param PutRequest $request
     *
     * @throws NoNextRouteException
     *
     * @return Command
     */
    private function tryNext(PutRequest $request): Command
    {
        if ($this->nextRoute === null) {
            throw new NoNextRouteException();
        }

        return $this->nextRoute->route($request);
    }
}
