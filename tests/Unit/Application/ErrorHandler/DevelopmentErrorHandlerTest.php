<?php declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\DevelopmentErrorHandler;
use Fury\Application\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\DevelopmentErrorHandler
 */
class DevelopmentErrorHandlerTest extends TestCase
{
    public function testHandleException()
    {
        $exception = new Exception('Some Exception');

        $errorHandler = $this->getErrorHandler();
        $errorHandler->expects($this->once())
            ->method('terminate')
            ->with($this->stringContains('Some Exception'));

        $errorHandler->handleException($exception);
    }

    /**
     * @return MockObject|DevelopmentErrorHandler
     */
    private function getErrorHandler()
    {
        return $this->createPartialMock(DevelopmentErrorHandler::class, ['terminate']);
    }
}
