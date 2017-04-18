<?php

declare(strict_types=1);
namespace Fury\Example;

use Fury\Application\ContentResult;
use Fury\Application\HtmlContent;
use Fury\Http\Query;
use Fury\Http\Result;

class RootQuery implements Query
{
    /**
     * @return Result
     */
    public function execute(): Result
    {
        return new ContentResult(new HtmlContent('<h1>Hello World!</h1>'));
    }
}
