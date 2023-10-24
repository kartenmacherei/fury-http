<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\Pattern;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\Pattern
 */
class PatternTest extends TestCase
{
    public function testAsStringReturnsExpectedValue(): void
    {
        $pattern = new Pattern('[a-zA-Z]{3}');
        $this->assertSame('/[a-zA-Z]{3}/', $pattern->asString());
    }
}
