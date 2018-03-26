<?php declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\NotFoundCommand;
use Fury\Application\NotFoundResult;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\NotFoundCommand
 * @uses \Fury\Application\NotFoundResult
 * @uses \Fury\Application\HtmlContent
 */
class NotFoundCommandTest extends TestCase
{
    public function testReturnsNotFoundResult()
    {
        $command = new NotFoundCommand();
        $this->assertInstanceOf(NotFoundResult::class, $command->execute());
    }
}
