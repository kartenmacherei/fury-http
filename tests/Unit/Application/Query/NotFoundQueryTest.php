<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Content\HtmlContent;
use Fury\Application\Query\NotFoundQuery;
use Fury\Application\Result\NotFoundResult;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Query\NotFoundQuery
 *
 * @uses \Fury\Application\Result\NotFoundResult
 * @uses \Fury\Application\Content\HtmlContent
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
