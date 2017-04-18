<?php

declare(strict_types=1);
namespace Fury\Example;

use Fury\Application\HtmlContent;

interface HtmlContentReader
{
    /**
     * @param Identifier $key
     *
     * @return bool
     */
    public function has(Identifier $key): bool;

    /**
     * @param Identifier $key
     *
     * @return HtmlContent
     */
    public function read(Identifier $key): HtmlContent;
}
