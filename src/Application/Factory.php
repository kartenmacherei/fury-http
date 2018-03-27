<?php

declare(strict_types=1);
namespace Fury\Application;

class Factory
{
    /**
     * @return ErrorHandler
     */
    public function createErrorHandler(): ErrorHandler
    {
        $errorHandlerLocator = $this->createErrorHandlerLocator();

        return $errorHandlerLocator->locate($this->createEnvironment());
    }

    /**
     * @return ErrorHandlerLocator
     */
    private function createErrorHandlerLocator(): ErrorHandlerLocator
    {
        return new ErrorHandlerLocator($this);
    }

    /**
     * @return DevelopmentErrorHandler
     */
    public function createDevelopmentErrorHandler(): DevelopmentErrorHandler
    {
        return new DevelopmentErrorHandler();
    }

    /**
     * @return ProductionErrorHandler
     */
    public function createProductionErrorHandler(): ProductionErrorHandler
    {
        return new ProductionErrorHandler();
    }

    /**
     * @return Environment
     */
    private function createEnvironment(): Environment
    {
        return Environment::fromSuperGlobals();
    }
}
