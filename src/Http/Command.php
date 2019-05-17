<?php

declare(strict_types=1);
namespace Fury\Http;

use Fury\Http\Result\Result;

interface Command
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
