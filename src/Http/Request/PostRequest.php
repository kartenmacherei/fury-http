<?php declare(strict_types=1);
namespace Frontend\Http;

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
