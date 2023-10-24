<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

class HtmlContent implements Content
{
    /** @var string */
    private $content;

    /** @param string $content */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function asString(): string
    {
        return $this->content;
    }

    public function getContentType(): ContentType
    {
        return new HtmlContentType();
    }
}
