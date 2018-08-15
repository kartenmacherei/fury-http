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

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    protected function getStatusCode(): StatusCode
    {
        return new OkStatusCode();
    }

    protected function getContent(): Content
    {
        return $this->content;
    }

    protected function flush(): void
    {
        $content = $this->getContent();
        header(sprintf(
            'Content-Type: %s; charset=UTF-8',
            $content->getContentType()->asString()
        ));
        echo $content->asString();
    }
}
