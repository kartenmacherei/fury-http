<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Result;

use Kartenmacherei\HttpFramework\Http\Domain;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use Kartenmacherei\HttpFramework\Http\Result\Result;

class RedirectResult implements Result
{
    /**
     * @var UriPath
     */
    private $uriPath;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var Domain|null
     */
    private $domain;

    public function __construct(UriPath $uriPath, array $parameters = [], ?Domain $domain = null)
    {
        $this->uriPath = $uriPath;
        $this->parameters = $parameters;
        $this->domain = $domain;
    }

    public function getUriPath(): UriPath
    {
        return $this->uriPath;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getDomain(): ?Domain
    {
        return $this->domain;
    }
}
