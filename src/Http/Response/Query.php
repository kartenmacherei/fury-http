<?php

declare(strict_types=1);
namespace Fury\Http;

interface Query
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
