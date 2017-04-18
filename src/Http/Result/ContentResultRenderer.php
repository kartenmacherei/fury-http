<?php

declare(strict_types=1);
namespace Fury\Http;

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
