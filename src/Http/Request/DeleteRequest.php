<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Request;

class DeleteRequest extends Request
{
    public function isDeleteRequest(): bool
    {
        return true;
    }
}
