<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Request;

abstract class PutRequest extends Request
{
    public function hasParameters(): bool
    {
        return false;
    }

    public function hasBody(): bool
    {
        return false;
    }

    public function isPutRequest(): bool
    {
        return true;
    }
}
