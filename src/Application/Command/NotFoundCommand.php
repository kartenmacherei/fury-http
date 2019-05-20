<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Command;

use Kartenmacherei\HttpFramework\Application\Content\HtmlContent;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Result\Result;

class NotFoundCommand implements Command
{
    public function execute(): Result
    {
        return new NotFoundResult(new HtmlContent(''));
    }
}
