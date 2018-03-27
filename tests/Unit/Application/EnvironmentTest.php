<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Environment;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Environment
 */
class EnvironmentTest extends TestCase
{
    /**
     * @dataProvider environmentTestDataProvider
     *
     * @param array $environmentVariables
     * @param bool $expectedValue
     */
    public function testReturnsExpectedValue(array $environmentVariables, bool $expectedValue)
    {
        $environment = new Environment($environmentVariables);
        $this->assertSame($expectedValue, $environment->isDevelopment());
    }

    /**
     * @runInSeparateProcess
     */
    public function testFromSuperGlobalsReturnsExpectedObject()
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
