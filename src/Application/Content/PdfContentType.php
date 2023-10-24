<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

class PdfContentType extends ContentType
{
    public function asString(): string
    {
        return 'application/pdf';
    }
}
