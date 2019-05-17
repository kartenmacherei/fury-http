<?php

declare(strict_types=1);
namespace Fury\Application\Result;

use Fury\Application\Response\NotFoundResponse;
use Fury\Http\Response\Response;
use Fury\Http\Result\ResultRenderer;

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
