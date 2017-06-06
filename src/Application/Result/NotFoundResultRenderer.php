<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Response;
use Fury\Http\ResultRenderer;

class NotFoundResultRenderer implements ResultRenderer
{
    /**
     * @var NotFoundResult
     */
    private $result;

    /**
     * @param NotFoundResult $result
     */
    public function __construct(NotFoundResult $result)
    {
        $this->result = $result;
    }

    /**
     * @return Response
     */
    public function render(): Response
    {
        return new NotFoundResponse($this->result->getContent());
    }
}
