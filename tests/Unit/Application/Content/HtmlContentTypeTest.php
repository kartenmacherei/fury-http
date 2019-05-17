<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content\HtmlContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Content\HtmlContentType
 */
class HtmlContentTypeTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $type = new HtmlContentType();
        $this->assertSame('text/html', $type->asString());
    }
}
