<?php

declare(strict_types=1);
namespace Fury\Application\Routing;

use Fury\Application\Command\NotFoundCommand;
use Fury\Http\Command;
use Fury\Http\Request\PostRequest;
use Fury\Http\Routing\PostRoute;

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
