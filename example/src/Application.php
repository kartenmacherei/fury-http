<?php declare(strict_types=1);
namespace Fury\Example;

use Fury\ContentResultRoute;
use Fury\GetRouter;
use Fury\NotFoundGetRoute;
use Fury\NotFoundResultRoute;
use Fury\PostRouter;
use Fury\ResultRouter;

class Application extends \Fury\Application
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
