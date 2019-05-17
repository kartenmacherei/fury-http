<?php

declare(strict_types=1);
namespace Fury\Application\Command;

use Fury\Application\Content\HtmlContent;
use Fury\Application\Result\NotFoundResult;
use Fury\Http\Command;
use Fury\Http\Result\Result;

class NotFoundCommand implements Command
{
    public function execute(): Result
    {
        return new NotFoundResult(new HtmlContent(''));
    }
}
