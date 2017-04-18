<?php

declare(strict_types=1);
namespace Fury\Http;

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
