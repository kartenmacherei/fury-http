<?php declare(strict_types=1);
namespace Fury\ErrorHandler;

use Throwable;

class ProductionErrorHandler extends ErrorHandler
{
    /**
     * @param Throwable $throwable
     */
    public function handleException(Throwable $throwable)
    {
        $this->terminate('Something went wrong :S');
    }
}
