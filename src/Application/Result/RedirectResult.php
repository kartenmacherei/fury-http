<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Result;

class RedirectResult implements Result
{
    /**
     * @var Content
     */
    private $content;

    /**
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }
}
