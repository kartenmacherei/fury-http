<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\Command;
use Fury\Http\PostRequest;
use Fury\Http\PostRoute;

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
        if($this->firstRoute === null)
        {
            $this->firstRoute = $route;
        }

        if($this->lastRoute !== null)
        {
            $this->lastRoute->setNextRoute($route);
        }

        $this->lastRoute = $route;
    }
}
