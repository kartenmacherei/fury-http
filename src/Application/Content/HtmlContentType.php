<?php

declare(strict_types=1);
namespace Fury\Application\Content;

class HtmlContentType extends ContentType
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return 'text/html';
    }
}
