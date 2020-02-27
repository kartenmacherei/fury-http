<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Application;

use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorException;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandler
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
