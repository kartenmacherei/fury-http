<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Result;

use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use Kartenmacherei\HttpFramework\Http\Result\Result;

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
