<?php

declare(strict_types=1);
namespace Fury\Application\Result;

use Fury\Application\Response\RedirectResponse;
use Fury\Http\Response\Response;
use Fury\Http\Result\ResultRenderer;

class RedirectRenderer implements ResultRenderer
{
    /**
     * @var RedirectResult
     */
    private $result;

    public function __construct(RedirectResult $result)
    {
        $this->result = $result;
    }

    public function render(): Response
    {
        return new RedirectResponse($this->result->getUriPath());
    }
}
