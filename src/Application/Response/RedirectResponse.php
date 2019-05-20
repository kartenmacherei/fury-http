<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Response;

use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use Kartenmacherei\HttpFramework\Http\Response\BaseResponse;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode\RedirectStatusCode;

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
