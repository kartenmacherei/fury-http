<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\Query;

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
