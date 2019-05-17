<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\ErrorHandler\DevelopmentErrorHandler;
use Fury\Application\ErrorHandler\ErrorHandler;
use Fury\Application\ErrorHandler\ProductionErrorHandler;
use Fury\Application\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Factory
 *
 * @uses \Fury\Application\ErrorHandler\ErrorHandler
 * @uses \Fury\Application\\ErrorHandler\Environment
 * @uses \Fury\Application\ErrorHandler\ErrorHandlerLocator
 */
class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    private $factory;

    protected function setUp(): void
    {
        $this->factory = new Factory();
    }

    public function testCreatesErrorHandler(): void
    {
        $this->assertInstanceOf(ErrorHandler::class, $this->factory->createErrorHandler());
    }

    public function testCreatesDevelopmentErrorHandler(): void
    {
        $this->assertInstanceOf(DevelopmentErrorHandler::class, $this->factory->createDevelopmentErrorHandler());
    }

    public function testCreatesProductionErrorHandler(): void
    {
        $this->assertInstanceOf(ProductionErrorHandler::class, $this->factory->createProductionErrorHandler());
    }
}
