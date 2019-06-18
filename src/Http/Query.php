<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http;

use Kartenmacherei\HttpFramework\Http\Result\Result;

interface Query
{
    /**
     * @return Result
     */
    public function execute(): Result;
}
