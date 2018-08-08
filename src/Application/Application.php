<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\GetRequest;
use Fury\Http\GetRouter;
use Fury\Http\PostRequest;
use Fury\Http\PostRouter;
use Fury\Http\Request;
use Fury\Http\Response;
use Fury\Http\ResultRouter;

abstract class Application
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        if ($request->isGetRequest()) {
            /* @var GetRequest $request */
            return $this->handleGetRequest($request);
        }

        if ($request->isPostRequest()) {
            /* @var PostRequest $request */
            return $this->handlePostRequest($request);
        }

        return new MethodNotAllowedResponse($request->getSupportedRequestMethods());
    }

    /**
     * @return GetRouter
     */
    abstract protected function createGetRouter(): GetRouter;

    /**
     * @return PostRouter
     */
    abstract protected function createPostRouter(): PostRouter;

    /**
     * @return ResultRouter
     */
    abstract protected function createResultRouter(): ResultRouter;

    /**
     * @param $request
     *
     * @return Response
     */
    private function handleGetRequest(GetRequest $request): Response
    {
        $router = $this->createGetRouter();
        $query = $router->route($request);

        $result = $query->execute();

        return $this->handleResult($result);
    }

    /**
     * @param $request
     *
     * @return Response
     */
    private function handlePostRequest(PostRequest $request): Response
    {
        $router = $this->createPostRouter();
        $command = $router->route($request);

        $result = $command->execute();

        return $this->handleResult($result);
    }

    /**
     * @param $result
     *
     * @return Response
     */
    private function handleResult($result): Response
    {
        $router = $this->createResultRouter();

        return $router->route($result)->render();
    }
}
