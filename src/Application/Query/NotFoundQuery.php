<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Query;

use Kartenmacherei\HttpFramework\Application\Content\HtmlContent;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use Kartenmacherei\HttpFramework\Http\Query;
use Kartenmacherei\HttpFramework\Http\Result\Result;

class NotFoundQuery implements Query
{
    /** @return Result */
    public function execute(): Result
    {
        return new NotFoundResult(new HtmlContent('<h1>404 Not Found</h1>'));
    }
}
