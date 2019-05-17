<?php

declare(strict_types=1);
namespace Fury\Application\Result;

use Fury\Application\Response\ContentResponse;
use Fury\Http\Response\Response;
use Fury\Http\Result\ResultRenderer;

class ContentResultRenderer implements ResultRenderer
{
    /**
     * @var ContentResult
     */
    private $result;

    /**
     * @param ContentResult $result
     */
    public function __construct(ContentResult $result)
    {
        $this->result = $result;
    }

    /**
     * @return Response
     */
    public function render(): Response
    {
        return new ContentResponse($this->result->getContent());
    }
}
