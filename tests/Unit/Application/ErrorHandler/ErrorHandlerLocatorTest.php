<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Application;

use Kartenmacherei\HttpFramework\Application\Environment;
use Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandlerLocator;
use Kartenmacherei\HttpFramework\Application\Factory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\ErrorHandler\ErrorHandlerLocator
 */
class ErrorHandlerLocatorTest extends TestCase
{
    /**
     * @dataProvider locatorTestDataProvider
     *
     * @param bool $isDevelopment
     * @param string $expectedFactoryMethod
     */
    public function testReturnsExpectedInstance(bool $isDevelopment, string $expectedFactoryMethod): void
    {
        $environment = $this->getEnvironmentMock();
        $environment->method('isDevelopment')->willReturn($isDevelopment);

        $factory = $this->getFactoryMock();
        $factory->expects($this->once())
            ->method($expectedFactoryMethod);

        $locator = new ErrorHandlerLocator($factory);
        $locator->locate($environment);
    }

    public function locatorTestDataProvider(): array
    {
        return [
            [true, 'createDevelopmentErrorHandler'],
            [false, 'createProductionErrorHandler'],
        ];
    }

    /**
     * @return MockObject|Environment
     */
    private function getEnvironmentMock()
    {
        return $this->createMock(Environment::class);
    }

    /**
     * @return MockObject|Factory
     */
    private function getFactoryMock()
    {
        return $this->createMock(Factory::class);
    }
}
