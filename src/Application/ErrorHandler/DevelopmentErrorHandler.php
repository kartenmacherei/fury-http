<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\ErrorHandler;

use Throwable;

class DevelopmentErrorHandler extends ErrorHandler
{
    /** @param Throwable $throwable */
    public function handleException(Throwable $throwable): void
    {
        $this->terminate('<pre>' . $throwable . "\n\n" . $throwable->getTraceAsString() . '</pre>');
    }
}
