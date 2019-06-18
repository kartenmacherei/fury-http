<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Routing;

use Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand;
use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\PostRequest;
use Kartenmacherei\HttpFramework\Http\Routing\PostRoute;

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
