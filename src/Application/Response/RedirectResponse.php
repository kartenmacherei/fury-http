<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\BaseResponse;
use Fury\Http\RedirectStatusCode;
use Fury\Http\StatusCode;
use Fury\Http\UriPath;

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
