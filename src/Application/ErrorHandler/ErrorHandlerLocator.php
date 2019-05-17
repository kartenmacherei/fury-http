<?php

declare(strict_types=1);
namespace Fury\Application\ErrorHandler;

use Fury\Application\Environment;
use Fury\Application\Factory;

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
