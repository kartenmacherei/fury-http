<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

interface Content
{
    public function asString(): string;

    public function getContentType(): ContentType;
}
