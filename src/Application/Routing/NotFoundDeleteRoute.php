<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Routing;

use Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand;
use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;
use Kartenmacherei\HttpFramework\Http\Routing\DeleteRoute;

class NotFoundDeleteRoute extends DeleteRoute
{
    protected function canRoute(DeleteRequest $request): bool
    {
        return true;
    }

    protected function getCommand(DeleteRequest $request): Command
    {
        return new NotFoundCommand();
    }
}
