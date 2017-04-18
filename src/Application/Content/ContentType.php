<?php

declare(strict_types=1);
namespace Fury\Application;

interface ContentType
{
    /**
     * @return string
     */
    public function asString(): string;
}
