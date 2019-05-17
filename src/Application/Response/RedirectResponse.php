<?php

declare(strict_types=1);
namespace Fury\Application\Response;

use Fury\Http\Request\UriPath;
use Fury\Http\Response\BaseResponse;
use Fury\Http\Response\StatusCode;
use Fury\Http\Response\StatusCode\RedirectStatusCode;

class RedirectResponse extends BaseResponse
{
    /**
     * @var UriPath
     */
    private $uriPath;

    /**
     * @param UriPath $uriPath
     */
    public function __construct(UriPath $uriPath)
    {
        $this->uriPath = $uriPath;
    }

    public function getStatusCode(): StatusCode
    {
        return new RedirectStatusCode();
    }

    protected function flush(): void
    {
        header(sprintf('Location: %s', $this->uriPath->asString()));
    }
}
