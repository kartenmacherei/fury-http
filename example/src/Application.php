<?php

declare(strict_types=1);
namespace Fury\Example;

use Fury\Application\ContentResultRoute;
use Fury\Application\NotFoundGetRoute;
use Fury\Application\NotFoundResultRoute;
use Fury\Http\GetRouter;
use Fury\Http\PostRouter;
use Fury\Http\ResultRouter;

class Application extends \Fury\Application\Application
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return GetRouter
     */
    protected function createGetRouter(): GetRouter
    {
        $router = $this->factory->createGetRouter();
        $router->addRoute(new RootGetRoute());
        $router->addRoute($this->factory->createPdpRoute());
        $router->addRoute(new NotFoundGetRoute());

        return $router;
    }

    /**
     * @return PostRouter
     */
    protected function createPostRouter(): PostRouter
    {
        return new PostRouter();
    }

    /**
     * @return ResultRouter
     */
    protected function createResultRouter(): ResultRouter
    {
        $router = new ResultRouter();
        $router->addRoute(new ContentResultRoute());
        $router->addRoute(new NotFoundResultRoute());

        return $router;
    }
}
