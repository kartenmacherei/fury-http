<?php declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\HtmlContent;
use Fury\Application\NotFoundQuery;
use Fury\Application\NotFoundResult;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\NotFoundQuery
 * @uses \Fury\Application\NotFoundResult
 * @uses \Fury\Application\HtmlContent
 */
class NotFoundQueryTest extends TestCase
{
    public function testReturnsExpectedResult()
    {
        $query = new NotFoundQuery();

        $expected = new NotFoundResult(new HtmlContent('<h1>404 Not Found</h1>'));

        $this->assertEquals($expected, $query->execute());
    }
}
