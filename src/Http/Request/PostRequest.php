<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Request;

abstract class PostRequest extends Request
{
    public function hasParameters(): bool
    {
        return false;
    }

    public function hasBody(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPostRequest(): bool
    {
        return true;
    }
}
