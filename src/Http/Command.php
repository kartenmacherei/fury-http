<?php declare(strict_types=1);
namespace Frontend\Http;

use Frontend\Result;

interface Command
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
