<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

class PdfContent implements Content
{
    /** @var string */
    private $content;

    /** @param string $content */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /** @return string */
    public function asString(): string
    {
        return $this->content;
    }

    /** @return ContentType */
    public function getContentType(): ContentType
    {
        return new PdfContentType();
    }
}
