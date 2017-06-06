<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Command;
use Fury\Http\PostRequest;
use Fury\Http\PostRoute;

class NotFoundPostRoute extends PostRoute
{
    protected function canRoute(PostRequest $request): bool
    {
        return true;
    }

    protected function getCommand(PostRequest $request): Command
    {
        return new NotFoundCommand();
    }


}
