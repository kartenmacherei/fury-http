<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\HtmlContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Content\HtmlContentType
 */
class HtmlContentTypeTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $type = new HtmlContentType();
        $this->assertSame('text/html', $type->asString());
    }
}
