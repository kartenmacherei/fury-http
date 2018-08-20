<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Response;
use Fury\Http\ResultRenderer;

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
