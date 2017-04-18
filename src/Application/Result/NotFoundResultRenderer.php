<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Response;
use Fury\Http\ResultRenderer;

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
