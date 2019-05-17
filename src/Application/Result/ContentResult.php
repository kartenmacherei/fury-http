<?php

declare(strict_types=1);
namespace Fury\Application\Result;

use Fury\Application\Content\Content;
use Fury\Http\Result\Result;

class ContentResult implements Result
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
