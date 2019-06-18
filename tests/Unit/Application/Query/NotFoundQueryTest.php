<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\UnitTests;

use Kartenmacherei\HttpFramework\Application\Content\HtmlContent;
use Kartenmacherei\HttpFramework\Application\Query\NotFoundQuery;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Query\NotFoundQuery
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Result\NotFoundResult
 * @uses \Kartenmacherei\HttpFramework\Application\Content\HtmlContent
 */
class NotFoundQueryTest extends TestCase
{
    public function testReturnsExpectedResult(): void
    {
        $query = new NotFoundQuery();

        $expected = new NotFoundResult(new HtmlContent('<h1>404 Not Found</h1>'));

        $this->assertEquals($expected, $query->execute());
    }
}
