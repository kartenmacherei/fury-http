<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Response;

use Kartenmacherei\HttpFramework\Application\Content\Content;
use Kartenmacherei\HttpFramework\Http\Response\BaseResponse;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode\OkStatusCode;

class ContentResponse extends BaseResponse
{
    /** @var Content */
    private $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    protected function getStatusCode(): StatusCode
    {
        return new OkStatusCode();
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
