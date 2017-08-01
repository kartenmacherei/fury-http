<?php

declare(strict_types=1);
namespace Fury\Application;

abstract class ContentType
{
    const JSON = 'application/json';
    const JSON_UTF8 = 'application/json; charset=UTF-8';
    const PLAIN = 'text/plain';

    /**
     * @return string
     */
    abstract public function asString(): string;
}
