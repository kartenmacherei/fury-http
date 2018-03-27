<?php declare(strict_types=1);
namespace Fury\Http\UnitTests;

use Fury\Http\Pattern;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Http\Pattern
 */
class PatternTest extends TestCase
{
    public function testAsStringReturnsExpectedValue()
    {
        $pattern = new Pattern('[a-zA-Z]{3}');
        $this->assertSame('/[a-zA-Z]{3}/', $pattern->asString());
    }
}
