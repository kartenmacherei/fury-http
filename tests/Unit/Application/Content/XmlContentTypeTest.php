<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\XmlContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Content\XmlContentType
 */
class XmlContentTypeTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $type = new XmlContentType();
        $this->assertSame('text/xml', $type->asString());
    }
}
