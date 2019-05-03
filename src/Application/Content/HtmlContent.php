<?php

declare(strict_types=1);
namespace Fury\Application;

class HtmlContent implements Content
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->content;
    }

    /**
     * @return ContentType
     */
    public function getContentType(): ContentType
    {
        return new HtmlContentType();
    }
}
