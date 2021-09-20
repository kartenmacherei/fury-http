<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\PdfContent;
use Kartenmacherei\HttpFramework\Application\Content\PdfContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Content\PdfContent
 */
class PdfContentTest extends TestCase
{
    public function testAsStringReturnsExpectedString(): void
    {
        $value = 'file content';
        $content = new PdfContent($value);

        $this->assertSame($value, $content->asString());
    }

    public function testGetContentTypeReturnsExpectedContentType(): void
    {
        $content = new PdfContent('');

        $this->assertEquals(new PdfContentType(), $content->getContentType());
    }
}
