<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\DevelopmentErrorHandler;
use Fury\Application\ErrorHandler;
use Fury\Application\Factory;
use Fury\Application\ProductionErrorHandler;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Factory
 *
 * @uses \Fury\Application\ErrorHandler
 * @uses \Fury\Application\Environment
 * @uses \Fury\Application\ErrorHandlerLocator
 */
class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    private $factory;

    protected function setUp()
    {
        $this->factory = new Factory();
    }

    public function testCreatesErrorHandler()
    {
        $this->assertInstanceOf(ErrorHandler::class, $this->factory->createErrorHandler());
    }

    public function testCreatesDevelopmentErrorHandler()
    {
        $this->assertInstanceOf(DevelopmentErrorHandler::class, $this->factory->createDevelopmentErrorHandler());
    }

    public function testCreatesProductionErrorHandler()
    {
        $this->assertInstanceOf(ProductionErrorHandler::class, $this->factory->createProductionErrorHandler());
    }
}
