<?php declare(strict_types=1);

namespace Fury\Application;
class JsonContentType implements ContentType
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return 'application/json';
    }

}
