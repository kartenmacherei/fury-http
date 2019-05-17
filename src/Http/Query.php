<?php

declare(strict_types=1);
namespace Fury\Http;

use Fury\Http\Result\Result;

interface Query
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
