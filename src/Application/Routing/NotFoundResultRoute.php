<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Routing;

use Kartenmacherei\HttpFramework\Application\Result\NotFoundResult;
use Kartenmacherei\HttpFramework\Application\Result\NotFoundResultRenderer;
use Kartenmacherei\HttpFramework\Http\Result\Result;
use Kartenmacherei\HttpFramework\Http\Result\ResultRenderer;
use Kartenmacherei\HttpFramework\Http\Routing\ResultRoute;

class NotFoundResultRoute extends ResultRoute
{
    protected function canRoute(Result $result): bool
    {
        return $result instanceof NotFoundResult;
    }

    protected function getResultRenderer(Result $result): ResultRenderer
    {
        /* @var NotFoundResult $result */
        return new NotFoundResultRenderer($result);
    }
}
