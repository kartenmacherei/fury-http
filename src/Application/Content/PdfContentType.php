<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

class PdfContentType extends ContentType
{
    /** @return string */
    public function asString(): string
    {
        return 'application/pdf';
    }
}
