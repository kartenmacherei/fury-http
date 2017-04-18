<?php

declare(strict_types=1);
namespace Fury\Http;

interface Command
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
