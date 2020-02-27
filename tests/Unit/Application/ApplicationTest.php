<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Application;
use Kartenmacherei\HttpFramework\Application\Response\MethodNotAllowedResponse;
use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Query;
use Kartenmacherei\HttpFramework\Http\Request\GetRequest;
use Kartenmacherei\HttpFramework\Http\Request\PostRequest;
use Kartenmacherei\HttpFramework\Http\Request\Request;
use Kartenmacherei\HttpFramework\Http\Request\SupportedRequestMethods;
use Kartenmacherei\HttpFramework\Http\Response\Response;
use Kartenmacherei\HttpFramework\Http\Result\Result;
use Kartenmacherei\HttpFramework\Http\Result\ResultRenderer;
use Kartenmacherei\HttpFramework\Http\Routing\GetRouter;
use Kartenmacherei\HttpFramework\Http\Routing\PostRouter;
use Kartenmacherei\HttpFramework\Http\Routing\ResultRouter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Application
 */
class ApplicationTest extends TestCase
{
    public function testHandlesGetRequest(): void
    {
        $request = $this->getGetRequestMock();
        $request->method('isGetRequest')->willReturn(true);

        $result = $this->getResultMock();

        $query = $this->getQueryMock();
        $query->expects($this->once())
            ->method('execute')
            ->willReturn($result);

        $router = $this->getGetRouterMock();
        $router->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($query);

        $response = $this->getResponseMock();

        $resultRenderer = $this->getResultRendererMock();
        $resultRenderer->expects($this->once())
            ->method('render')
            ->willReturn($response);

        $resultRouter = $this->getResultRouterMock();
        $resultRouter->expects($this->once())
            ->method('route')
            ->with($result)
            ->willReturn($resultRenderer);

        $application = $this->getApplication();
        $application->method('createGetRouter')->willReturn($router);
        $application->method('createResultRouter')->willReturn($resultRouter);

        $this->assertSame($response, $application->handle($request));
    }

    public function testHandlesPostRequest(): void
    {
        $request = $this->getPostRequestMock();
        $request->method('isGetRequest')->willReturn(false);
        $request->method('isPostRequest')->willReturn(true);

        $result = $this->getResultMock();

        $command = $this->getCommandMock();
        $command->expects($this->once())
            ->method('execute')
            ->willReturn($result);

        $router = $this->getPostRouterMock();
        $router->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($command);

        $response = $this->getResponseMock();

        $resultRenderer = $this->getResultRendererMock();
        $resultRenderer->expects($this->once())
            ->method('render')
            ->willReturn($response);

        $resultRouter = $this->getResultRouterMock();
        $resultRouter->expects($this->once())
            ->method('route')
            ->with($result)
            ->willReturn($resultRenderer);

        $application = $this->getApplication();
        $application->method('createPostRouter')->willReturn($router);
        $application->method('createResultRouter')->willReturn($resultRouter);

        $this->assertSame($response, $application->handle($request));
    }

    /**
     * @uses \Kartenmacherei\HttpFramework\Application\Response\MethodNotAllowedResponse
     */
    public function testReturnsUnsupportedRequestTypeExceptionIfRequestIsNeitherGetNorPost(): void
    {
        $request = $this->getRequestMock();
        $supportedRequestMethodsMock = $this->createMock(SupportedRequestMethods::class);
        $request->method('isGetRequest')->willReturn(false);
        $request->method('isPostRequest')->willReturn(false);
        $request->method('getSupportedRequestMethods')->willReturn($supportedRequestMethodsMock);

        $application = $this->getApplication();
        $this->assertInstanceOf(MethodNotAllowedResponse::class, $application->handle($request));
    }

    /**
     * @return MockObject|Request
     */
    private function getRequestMock()
    {
        return $this->createMock(Request::class);
    }

    /**
     * @return MockObject|Application
     */
    private function getApplication()
    {
        return $this->getMockForAbstractClass(Application::class);
    }

    /**
     * @return MockObject|PostRouter
     */
    private function getPostRouterMock()
    {
        return $this->createMock(PostRouter::class);
    }

    /**
     * @return MockObject|PostRequest
     */
    private function getPostRequestMock()
    {
        return $this->createMock(PostRequest::class);
    }

    /**
     * @return MockObject|Command
     */
    private function getCommandMock()
    {
        return $this->createMock(Command::class);
    }

    /**
     * @return MockObject|Response
     */
    private function getResponseMock()
    {
        return $this->createMock(Response::class);
    }

    /**
     * @return MockObject|ResultRenderer
     */
    private function getResultRendererMock()
    {
        return $this->createMock(ResultRenderer::class);
    }

    /**
     * @return MockObject|ResultRouter
     */
    private function getResultRouterMock()
    {
        return $this->createMock(ResultRouter::class);
    }

    /**
     * @return MockObject|Result
     */
    private function getResultMock()
    {
        return $this->createMock(Result::class);
    }

    /**
     * @return MockObject|GetRequest
     */
    private function getGetRequestMock()
    {
        return $this->createMock(GetRequest::class);
    }

    /**
     * @return MockObject|Query
     */
    private function getQueryMock()
    {
        return $this->createMock(Query::class);
    }

    /**
     * @return MockObject|GetRouter
     */
    private function getGetRouterMock()
    {
        return $this->createMock(GetRouter::class);
    }
}
