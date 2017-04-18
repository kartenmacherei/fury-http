<?php declare(strict_types=1);
namespace Fury\Http;

class PostRequest extends Request
{
    /**
     * @return bool
     */
    public function isPostRequest(): bool
    {
        return true;
    }
}
