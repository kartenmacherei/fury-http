<?php declare(strict_types=1);
namespace Frontend\Http;

use Frontend\Result;

interface Query
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
