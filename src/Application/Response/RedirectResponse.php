<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Response;

use Kartenmacherei\HttpFramework\Http\Domain;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use Kartenmacherei\HttpFramework\Http\Response\BaseResponse;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode\RedirectStatusCode;

class RedirectResponse extends BaseResponse
{
    /** @var UriPath */
    private $uriPath;

    /** @var array|null */
    private $parameters;

    /** @var Domain|null */
    private $domain;

    public function __construct(UriPath $uriPath, array $parameters = [], ?Domain $domain = null)
    {
        $this->uriPath = $uriPath;
        $this->parameters = $parameters;
        $this->domain = $domain;
    }

    public function getStatusCode(): StatusCode
    {
        return new RedirectStatusCode();
    }

    protected function flush(): void
    {
        $queryString = '';
        if (!empty($this->parameters)) {
            $queryString = sprintf('?%s', http_build_query($this->parameters));
        }
        $domainName = '';
        if ($this->domain) {
            $domainName = sprintf('https://%s', $this->domain->asString());
        }

        header(sprintf('Location: %s%s%s', $domainName, $this->uriPath->asString(), $queryString));
    }
}
