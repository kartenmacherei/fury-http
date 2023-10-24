<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application;

use Kartenmacherei\HttpFramework\Application\ErrorHandler\DevelopmentErrorHandler;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandler;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandlerLocator;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ProductionErrorHandler;

class Factory
{
    /** @return ErrorHandler */
    public function createErrorHandler(): ErrorHandler
    {
        $errorHandlerLocator = $this->createErrorHandlerLocator();

        return $errorHandlerLocator->locate($this->createEnvironment());
    }

    /** @return DevelopmentErrorHandler */
    public function createDevelopmentErrorHandler(): DevelopmentErrorHandler
    {
        return new DevelopmentErrorHandler();
    }

    /** @return ProductionErrorHandler */
    public function createProductionErrorHandler(): ProductionErrorHandler
    {
        return new ProductionErrorHandler();
    }

    /** @return ErrorHandlerLocator */
    private function createErrorHandlerLocator(): ErrorHandlerLocator
    {
        return new ErrorHandlerLocator($this);
    }

    /** @return Environment */
    private function createEnvironment(): Environment
    {
        return Environment::fromSuperGlobals();
    }
}
