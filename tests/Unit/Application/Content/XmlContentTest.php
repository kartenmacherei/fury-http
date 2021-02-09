<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\XmlContent;
use Kartenmacherei\HttpFramework\Application\Content\XmlContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Content\XmlContent
 */
class XmlContentTest extends TestCase
{
    public function testAsStringReturnsExpectedString(): void
    {
        $value = '<xml><body>foo</body></xml>';
        $content = new XmlContent($value);

        $this->assertSame($value, $content->asString());
    }

    public function testGetContentTypeReturnsExpectedContentType(): void
    {
        $content = new XmlContent('');

        $this->assertEquals(new XmlContentType(), $content->getContentType());
    }
}
