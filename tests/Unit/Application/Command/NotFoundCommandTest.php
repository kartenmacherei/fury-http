<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Command\NotFoundCommand;
use Fury\Application\Result\NotFoundResult;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Command\NotFoundCommand
 *
 * @uses \Fury\Application\Result\NotFoundResult
 * @uses \Fury\Application\Content\HtmlContent
 */
class NotFoundCommandTest extends TestCase
{
    public function testReturnsNotFoundResult(): void
    {
        $command = new NotFoundCommand();
        $this->assertInstanceOf(NotFoundResult::class, $command->execute());
    }
}
