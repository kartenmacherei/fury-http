<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\ErrorHandler;

use Throwable;

class ProductionErrorHandler extends ErrorHandler
{
    /** @param Throwable $throwable */
    public function handleException(Throwable $throwable): void
    {
        $this->terminate('Something went wrong :S');
    }
}
