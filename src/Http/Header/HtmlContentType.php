<?php declare(strict_types=1);

namespace Fury\Http;

class HtmlContentType implements ContentType
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return 'text/html';
    }
}
