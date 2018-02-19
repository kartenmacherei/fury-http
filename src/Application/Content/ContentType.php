<?php

declare(strict_types=1);
namespace Fury\Application;

abstract class ContentType
{
    const JSON = 'application/json';
    const JSON_UTF8 = 'application/json; charset=UTF-8';
    const PLAIN = 'text/plain';
    const WWW_FORM = 'application/x-www-form-urlencoded';
    const WWW_FORM_UTF8 = 'application/x-www-form-urlencoded; charset=UTF-8';

    /**
     * @return string
     */
    abstract public function asString(): string;
}
