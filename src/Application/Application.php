<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application;

use Kartenmacherei\HttpFramework\Application\Response\MethodNotAllowedResponse;
use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;
use Kartenmacherei\HttpFramework\Http\Request\GetRequest;
use Kartenmacherei\HttpFramework\Http\Request\PostRequest;
use Kartenmacherei\HttpFramework\Http\Request\PutRequest;
use Kartenmacherei\HttpFramework\Http\Request\Request;
use Kartenmacherei\HttpFramework\Http\Response\Response;
use Kartenmacherei\HttpFramework\Http\Routing\DeleteRouter;
use Kartenmacherei\HttpFramework\Http\Routing\GetRouter;
use Kartenmacherei\HttpFramework\Http\Routing\PostRouter;
use Kartenmacherei\HttpFramework\Http\Routing\PutRouter;
use Kartenmacherei\HttpFramework\Http\Routing\ResultRouter;

abstract class Application
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request): Response
    {
        if ($request->isDeleteRequest()) {
            /* @var DeleteRequest $request */
            return $this->handleDeleteRequest($request);
        }

        if ($request->isGetRequest()) {
            /* @var GetRequest $request */
            return $this->handleGetRequest($request);
        }

        if ($request->isPostRequest()) {
            /* @var PostRequest $request */
            return $this->handlePostRequest($request);
        }

        if ($request->isPutRequest()) {
            /* @var PutRequest $request */
            return $this->handlePutRequest($request);
        }

        return new MethodNotAllowedResponse($request->getSupportedRequestMethods());
    }

    abstract protected function createGetRouter(): GetRouter;

    abstract protected function createPostRouter(): PostRouter;

    abstract protected function createDeleteRouter(): DeleteRouter;

    abstract protected function createPutRouter(): PutRouter;

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

    private function handleDeleteRequest(DeleteRequest $request): Response
    {
        $router = $this->createDeleteRouter();
        $command = $router->route($request);
        $result = $command->execute();

        return $this->handleResult($result);
    }

    private function handlePutRequest(PutRequest $request): Response
    {
        $router = $this->createPutRouter();
        $command = $router->route($request);

        $result = $command->execute();

        return $this->handleResult($result);
    }
}
