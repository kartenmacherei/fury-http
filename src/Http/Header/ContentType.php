<?php declare(strict_types=1);
namespace Frontend\Http;

interface ContentType
{
    /**
     * @return string
     */
    public function asString(): string;
}
