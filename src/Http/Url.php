<?php declare(strict_types=1);

namespace Fury\Http;

class Url
{
    private $value = '';

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function asString(): string
    {
        return $this->value;
    }
}
