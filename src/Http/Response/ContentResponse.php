<?php declare(strict_types=1);

namespace Fury\Http;

use Fury\Http\StatusCode\OkStatusCode;
use Fury\Http\StatusCode\StatusCode;

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
