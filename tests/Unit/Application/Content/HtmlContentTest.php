<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\HtmlContent;
use Fury\Application\HtmlContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\HtmlContent
 */
class HtmlContentTest extends TestCase
{
    public function testAsStringReturnsExpectedString()
    {
        $value = '<html><body>foo</body></html>';
        $content = new HtmlContent($value);

        $this->assertSame($value, $content->asString());
    }

    public function testGetContentTypeReturnsExpectedContentType()
    {
        $content = new HtmlContent('');

        $this->assertEquals(new HtmlContentType(), $content->getContentType());
    }
}
