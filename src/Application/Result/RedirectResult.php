<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\Result;
use Fury\Http\UriPath;

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
