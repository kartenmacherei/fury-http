<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTests\Application;

use Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand
 *
 * @uses \Kartenmacherei\HttpFramework\Application\Result\NotFoundResult
 * @uses \Kartenmacherei\HttpFramework\Application\Content\HtmlContent
 */
class NotFoundCommandTest extends TestCase
{
    public function testReturnsNotFoundResult(): void
    {
        $command = new NotFoundCommand();
        $this->assertInstanceOf(NotFoundResult::class, $command->execute());
    }
}
