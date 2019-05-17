<?php

declare(strict_types=1);
namespace Fury\Application\Response;

use Fury\Application\Content\Content;
use Fury\Http\Response\BaseResponse;
use Fury\Http\Response\StatusCode;
use Fury\Http\Response\StatusCode\OkStatusCode;

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
