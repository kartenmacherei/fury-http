<?php declare(strict_types=1);
namespace Fury\Http;

interface ContentType
{
    /**
     * @return string
     */
    public function asString(): string;
}
