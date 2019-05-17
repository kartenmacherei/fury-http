<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content\HtmlContent;
use Fury\Application\Content\HtmlContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Content\HtmlContent
 */
class HtmlContentTest extends TestCase
{
    public function testAsStringReturnsExpectedString(): void
    {
        $value = '<html><body>foo</body></html>';
        $content = new HtmlContent($value);

        $this->assertSame($value, $content->asString());
    }

    public function testGetContentTypeReturnsExpectedContentType(): void
    {
        $content = new HtmlContent('');

        $this->assertEquals(new HtmlContentType(), $content->getContentType());
    }
}
