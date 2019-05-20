<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\ErrorHandler;

use Kartenmacherei\HttpFramework\Application\Environment;
use Kartenmacherei\HttpFramework\Application\Factory;

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
