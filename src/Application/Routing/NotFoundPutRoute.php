<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Routing;

use Kartenmacherei\HttpFramework\Application\Command\NotFoundCommand;
use Kartenmacherei\HttpFramework\Http\Command;
use Kartenmacherei\HttpFramework\Http\Request\PutRequest;
use Kartenmacherei\HttpFramework\Http\Routing\PutRoute;

class NotFoundPutRoute extends PutRoute
{
    protected function canRoute(PutRequest $request): bool
    {
        return true;
    }

    protected function getCommand(PutRequest $request): Command
    {
        return new NotFoundCommand();
    }
}
