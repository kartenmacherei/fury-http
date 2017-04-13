<?php declare(strict_types=1);

namespace Frontend\ErrorHandler;

use Frontend\Environment;
use Frontend\Factory;

class ErrorHandlerLocator
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Environment $environment
     *
     * @return ErrorHandler
     */
    public function locate(Environment $environment): ErrorHandler
    {
        if ($environment->isDevelopment()) {
            return $this->factory->createDevelopmentErrorHandler();
        }

        return $this->factory->createProductionErrorHandler();
    }
}