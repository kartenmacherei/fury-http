<?php declare(strict_types=1);
namespace Fury\Http;

use Fury\Result;

interface Command
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
