<?php

declare(strict_types=1);
namespace Fury\Application;

class PlainContentType extends ContentType
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return self::PLAIN;
    }
}
