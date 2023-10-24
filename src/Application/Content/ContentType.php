<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

abstract class ContentType
{
    public const JSON = 'application/json';
    public const JSON_UTF8 = 'application/json; charset=UTF-8';
    public const PLAIN = 'text/plain';
    public const WWW_FORM = 'application/x-www-form-urlencoded';
    public const WWW_FORM_UTF8 = 'application/x-www-form-urlencoded; charset=UTF-8';

    /** @return string */
    abstract public function asString(): string;
}
