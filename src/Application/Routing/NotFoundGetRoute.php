<?php

declare(strict_types=1);
namespace Fury\Application\Routing;

use Fury\Application\Query\NotFoundQuery;
use Fury\Http\Query;
use Fury\Http\Request\GetRequest;
use Fury\Http\Routing\GetRoute;

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
