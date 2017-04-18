<?php

declare(strict_types=1);
namespace Fury\Http;

class NotFoundResultRenderer implements ResultRenderer
{
    /**
     * @return Response
     */
    public function render(): Response
    {
        return new NotFoundResponse();
    }
}
