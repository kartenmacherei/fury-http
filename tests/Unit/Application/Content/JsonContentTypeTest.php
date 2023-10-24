<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Content\JsonContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Content\JsonContentType
 */
class JsonContentTypeTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $type = new JsonContentType();
        $this->assertSame('application/json', $type->asString());
    }
}
