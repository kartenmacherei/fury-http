<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Routing;

use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\PostRequest;

abstract class PostRoute
{
    /**
     * @var PostRoute
     */
    private $nextRoute;

    /**
     * @param PostRoute $route
     */
    public function setNextRoute(PostRoute $route): void
    {
        $this->nextRoute = $route;
    }

    /**
     * @param PostRequest $request
     *
     * @return Command
     */
    public function route(PostRequest $request): Command
    {
        if ($this->canRoute($request) === false) {
            return $this->tryNext($request);
        }

        return $this->getCommand($request);
    }

    /**
     * @param PostRequest $request
     *
     * @return bool
     */
    abstract protected function canRoute(PostRequest $request): bool;

    /**
     * @param PostRequest $request
     *
     * @return Command
     */
    abstract protected function getCommand(PostRequest $request): Command;

    /**
     * @param PostRequest $request
     *
     * @throws NoNextRouteException
     *
     * @return Command
     */
    private function tryNext(PostRequest $request): Command
    {
        if ($this->nextRoute === null) {
            throw new NoNextRouteException();
        }

        return $this->nextRoute->route($request);
    }
}
