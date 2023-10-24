<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application;

use Kartenmacherei\HttpFramework\Application\ErrorHandler\DevelopmentErrorHandler;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandler;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandlerLocator;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ProductionErrorHandler;

class Factory
{
    public function createErrorHandler(): ErrorHandler
    {
        $errorHandlerLocator = $this->createErrorHandlerLocator();

        return $errorHandlerLocator->locate($this->createEnvironment());
    }

    public function createDevelopmentErrorHandler(): DevelopmentErrorHandler
    {
        return new DevelopmentErrorHandler();
    }

    public function createProductionErrorHandler(): ProductionErrorHandler
    {
        return new ProductionErrorHandler();
    }

    private function createErrorHandlerLocator(): ErrorHandlerLocator
    {
        return new ErrorHandlerLocator($this);
    }

    private function createEnvironment(): Environment
    {
        return Environment::fromSuperGlobals();
    }
}
