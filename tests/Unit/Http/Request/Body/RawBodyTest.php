<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Http;

use Kartenmacherei\HttpFramework\Http\Request\Body\RawBody;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\Body\RawBody
 */
class RawBodyTest extends TestCase
{
    public function testReturnsExpectedString(): void
    {
        $body = new RawBody('some content');
        $this->assertSame('some content', $body->getContent());
    }
}
