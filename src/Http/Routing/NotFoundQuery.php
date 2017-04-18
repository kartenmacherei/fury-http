<?php

declare(strict_types=1);
namespace Fury\Http;

class NotFoundQuery implements Query
{
    /**
     * @return Result
     */
    public function execute(): Result
    {
        return new NotFoundResult();
    }
}
