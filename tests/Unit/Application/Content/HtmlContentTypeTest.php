<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\HtmlContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\HtmlContentType
 */
class HtmlContentTypeTest extends TestCase
{
    public function testReturnsExpectedString()
    {
        $type = new HtmlContentType();
        $this->assertSame('text/html', $type->asString());
    }
}
