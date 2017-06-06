<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Query;
use Fury\Http\Result;

class NotFoundQuery implements Query
{
    /**
     * @return Result
     */
    public function execute(): Result
    {
        return new NotFoundResult(new HtmlContent('<h1>404 Not Found</h1>'));
    }
}
