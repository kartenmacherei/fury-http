<?php declare(strict_types=1);

namespace Fury;
use Fury\Http\Response;
use Fury\NotFoundResponse;
use Fury\ResultRenderer;

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
