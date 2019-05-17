<?php

declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\EnsureException;
use Fury\Http\Request\SupportedRequestMethods;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Request\SupportedRequestMethods
 */
class SupportedRequestMethodsTest extends TestCase
{
    public function validMethodsProvider(): array
    {
        return [
            'single method' => [['get'], 'GET'],
            'multiple methods' => [['get', 'Post'], 'GET, POST'],
        ];
    }

    /**
     * @dataProvider validMethodsProvider
     *
     * @param array $inputMethods
     * @param string $expected
     */
    public function testAsStringReturnsConcatenatedMethods(array $inputMethods, string $expected): void
    {
        $supportedRequestMethods = new SupportedRequestMethods(...$inputMethods);
        $this->assertEquals($expected, $supportedRequestMethods->asString());
    }

    public function invalidMethodsProvider(): array
    {
        return [
            'no method' => [[]],
            'single invalid method' => [['foo']],
            'multiple invalid methods' => [['foo', 'bar']],
            'mixed methods' => [['get', 'bar']],
        ];
    }

    /**
     * @dataProvider invalidMethodsProvider
     *
     * @param array $inputMethods
     * @param string $expected
     */
    public function testAsStringThrowsExceptionOnInvalidMethods(array $inputMethods): void
    {
        $this->expectException(EnsureException::class);
        $this->expectExceptionMessage('invalid http method provided');
        new SupportedRequestMethods(...$inputMethods);
    }
}
