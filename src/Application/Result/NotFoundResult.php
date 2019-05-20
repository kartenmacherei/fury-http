<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Result;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Http\Result\Result;

class NotFoundResult implements Result
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
