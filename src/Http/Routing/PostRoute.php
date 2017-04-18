<?php declare(strict_types=1);
namespace Fury\Http;

abstract class PostRoute
{
    /**
     * @var PostRoute
     */
    private $nextRoute;

    /**
     * @param PostRoute $route
     */
    public function setNextRoute(PostRoute $route)
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
        if($this->canRoute($request) === false)
        {
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
     * @return Command
     *
     * @throws NoNextRouteException
     */
    private function tryNext(PostRequest $request): Command
    {
        if($this->nextRoute === null)
        {
            throw new NoNextRouteException();
        }

        return $this->nextRoute->route($request);
    }
}
