<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\GetRequest;
use Fury\Http\PostRequest;
use Fury\Http\Request;
use Fury\Http\Response;

abstract class Application
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        if($request->isGetRequest())
        {
            /** @var GetRequest $request */
            return $this->handleGetRequest($request);
        }

        if($request->isPostRequest())
        {
            /** @var PostRequest $request */
            return $this->handlePostRequest($request);
        }

        return new UnsupportedRequestTypeResponse();
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
