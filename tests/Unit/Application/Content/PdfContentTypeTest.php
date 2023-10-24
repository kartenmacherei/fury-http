<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\PdfContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Content\PdfContentType
 */
class PdfContentTypeTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $type = new PdfContentType();
        $this->assertSame('application/pdf', $type->asString());
    }
}
