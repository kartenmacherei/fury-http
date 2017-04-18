<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\BaseResponse;
use Fury\Http\OkStatusCode;
use Fury\Http\StatusCode;

class ContentResponse extends BaseResponse
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
     * @return StatusCode
     */
    protected function getStatusCode(): StatusCode
    {
        return new OkStatusCode();
    }

    protected function flush()
    {
        header(sprintf(
            'Content-Type: %s; charset=UTF-8',
            $this->content->getContentType()->asString()
        ));
        echo $this->content->asString();
    }
}
