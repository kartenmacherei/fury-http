<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\ErrorException;
use Fury\Application\ErrorHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\ErrorHandler
 */
class ErrorHandlerTest extends TestCase
{
    public function testHandleErrorThrowsExpectedException(): void
    {
        $errorHandler = $this->getErrorHandler();

        $this->expectExceptionObject(new ErrorException('some error', 12, 0, 'some/file.php', 42));

        $errorHandler->handleError(
            12,
            'some error',
            'some/file.php',
            42
        );
    }

    /**
     * @return MockObject|ErrorHandler
     */
    private function getErrorHandler()
    {
        return $this->getMockForAbstractClass(ErrorHandler::class);
    }
}
