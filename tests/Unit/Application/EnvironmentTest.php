<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Environment;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Environment
 */
class EnvironmentTest extends TestCase
{
    /**
     * @dataProvider environmentTestDataProvider
     *
     * @param array $environmentVariables
     * @param bool $expectedValue
     */
    public function testReturnsExpectedValue(array $environmentVariables, bool $expectedValue): void
    {
        $environment = new Environment($environmentVariables);
        $this->assertSame($expectedValue, $environment->isDevelopment());
    }

    /**
     * @runInSeparateProcess
     */
    public function testFromSuperGlobalsReturnsExpectedObject(): void
    {
        $_SERVER = ['foo' => 'bar'];
        $expected = new Environment($_SERVER);
        $this->assertEquals($expected, Environment::fromSuperGlobals());
    }

    public function environmentTestDataProvider()
    {
        return [
            [[], false],
            [['FURY_ENV' => 'development'], true],
            [['FURY_ENV' => 'dev'], false],
            [['FURY_ENV' => 'production'], false],
        ];
    }
}
