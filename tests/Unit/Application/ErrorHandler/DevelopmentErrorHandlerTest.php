<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\ErrorHandler\DevelopmentErrorHandler;
use Kartenmacherei\HttpFramework\Application\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\ErrorHandler\DevelopmentErrorHandler
 */
class DevelopmentErrorHandlerTest extends TestCase
{
    public function testHandleException(): void
    {
        $exception = new Exception('Some Exception');

        $errorHandler = $this->getErrorHandler();
        $errorHandler->expects($this->once())
            ->method('terminate')
            ->with($this->stringContains('Some Exception'));

        $errorHandler->handleException($exception);
    }

    /** @return MockObject|DevelopmentErrorHandler */
    private function getErrorHandler()
    {
        return $this->createPartialMock(DevelopmentErrorHandler::class, ['terminate']);
    }
}
