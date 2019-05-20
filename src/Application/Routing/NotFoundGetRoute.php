<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Routing;

use Kartenmacherei\HttpFramework\Application\Query\NotFoundQuery;
use Kartenmacherei\HttpFramework\Http\Query;
use Kartenmacherei\HttpFramework\Http\Request\GetRequest;
use Kartenmacherei\HttpFramework\Http\Routing\GetRoute;

class NotFoundGetRoute extends GetRoute
{
    protected function canRoute(GetRequest $request): bool
    {
        return true;
    }

    protected function getQuery(GetRequest $request): Query
    {
        return new NotFoundQuery();
    }
}
