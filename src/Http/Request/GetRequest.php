<?php declare(strict_types=1);
namespace Fury\Http;

class GetRequest extends Request
{
    /**
     * @return bool
     */
    public function isGetRequest(): bool
    {
        return true;
    }
}
