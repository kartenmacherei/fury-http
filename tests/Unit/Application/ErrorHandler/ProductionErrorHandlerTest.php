<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\ErrorHandler\ProductionErrorHandler;
use Kartenmacherei\HttpFramework\Application\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\ErrorHandler\ProductionErrorHandler
 */
class ProductionErrorHandlerTest extends TestCase
{
    public function testHandleException(): void
    {
        $exception = new Exception('Some Exception');

        $errorHandler = $this->getErrorHandler();
        $errorHandler->expects($this->once())
            ->method('terminate')
            ->with('Something went wrong :S');

        $errorHandler->handleException($exception);
    }

    /**
     * @return MockObject|ProductionErrorHandler
     */
    private function getErrorHandler()
    {
        return $this->createPartialMock(ProductionErrorHandler::class, ['terminate']);
    }
}
