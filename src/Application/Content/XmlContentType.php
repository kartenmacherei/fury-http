<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

class XmlContentType extends ContentType
{
    public function asString(): string
    {
        return 'text/xml';
    }
}
