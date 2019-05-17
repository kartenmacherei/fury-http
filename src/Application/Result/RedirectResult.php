<?php

declare(strict_types=1);
namespace Fury\Application\Result;

use Fury\Http\Request\UriPath;
use Fury\Http\Result\Result;

class RedirectResult implements Result
{
    /**
     * @var UriPath
     */
    private $uriPath;

    public function __construct(UriPath $uriPath)
    {
        $this->uriPath = $uriPath;
    }

    public function getUriPath(): UriPath
    {
        return $this->uriPath;
    }
}
