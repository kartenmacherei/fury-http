<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

class JsonContentType extends ContentType
{
    public function asString(): string
    {
        return self::JSON;
    }
}
