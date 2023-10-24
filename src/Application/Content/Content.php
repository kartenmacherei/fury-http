<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

interface Content
{
    /** @return string */
    public function asString(): string;

    /** @return ContentType */
    public function getContentType(): ContentType;
}
