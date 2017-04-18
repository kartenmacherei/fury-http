<?php

declare(strict_types=1);
namespace Fury\Example;

use Fury\Http\GetRequest;
use Fury\Http\GetRoute;
use Fury\Http\Query;

class RootGetRoute extends GetRoute
{
    /**
     * @param GetRequest $request
     *
     * @return bool
     */
    protected function canRoute(GetRequest $request): bool
    {
        return $request->getPath()->asString() === '/';
    }

    /**
     * @param GetRequest $request
     *
     * @return Query
     */
    protected function getQuery(GetRequest $request): Query
    {
        return new RootQuery();
    }
}
