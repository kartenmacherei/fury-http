<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\GetRequest;
use Fury\Http\GetRoute;
use Fury\Http\Query;

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
