<?php declare(strict_types=1);
namespace Frontend\ErrorHandler;

use Throwable;

class DevelopmentErrorHandler extends ErrorHandler
{
    /**
     * @param Throwable $throwable
     */
    public function handleException(Throwable $throwable)
    {
        $this->terminate('<pre>' . $throwable . "\n\n" . $throwable->getTraceAsString() . '</pre>');
    }
}
