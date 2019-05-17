<?php

declare(strict_types=1);
namespace Fury\Http\Routing;

use Fury\Http\Query;
use Fury\Http\Request\GetRequest;

abstract class GetRoute
{
    /**
     * @var GetRoute
     */
    private $nextRoute;

    /**
     * @param GetRoute $route
     */
    public function setNextRoute(GetRoute $route): void
    {
        $this->nextRoute = $route;
    }

    /**
     * @param GetRequest $request
     *
     * @return Query
     */
    public function route(GetRequest $request): Query
    {
        if ($this->canRoute($request) === false) {
            return $this->tryNext($request);
        }

        return $this->getQuery($request);
    }

    /**
     * @param GetRequest $request
     *
     * @return bool
     */
    abstract protected function canRoute(GetRequest $request): bool;

    /**
     * @param GetRequest $request
     *
     * @return Query
     */
    abstract protected function getQuery(GetRequest $request): Query;

    /**
     * @param GetRequest $request
     *
     * @throws NoNextRouteException
     *
     * @return Query
     */
    private function tryNext(GetRequest $request): Query
    {
        if ($this->nextRoute === null) {
            throw new NoNextRouteException();
        }

        return $this->nextRoute->route($request);
    }
}
