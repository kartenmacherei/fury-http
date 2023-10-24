<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\ErrorHandler\DevelopmentErrorHandler;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandler;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ProductionErrorHandler;
use Kartenmacherei\HttpFramework\Application\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Factory
 *
 * @uses \Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandler
 * @uses \Kartenmacherei\HttpFramework\Application\Environment
 * @uses \Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandlerLocator
 */
class FactoryTest extends TestCase
{
    /** @var Factory */
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
