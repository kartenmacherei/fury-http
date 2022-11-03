<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Response;

use Kartenmacherei\HttpFramework\Http\Request\SupportedRequestMethods;
use Kartenmacherei\HttpFramework\Http\Response\BaseResponse;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode;
use Kartenmacherei\HttpFramework\Http\Response\StatusCode\MethodNotAllowedCode;

class MethodNotAllowedResponse extends BaseResponse
{
    /** @var SupportedRequestMethods */
    private $supportedRequestMethods;

    public function __construct(SupportedRequestMethods $supportedRequestMethods)
    {
        $this->supportedRequestMethods = $supportedRequestMethods;
    }

    protected function getStatusCode(): StatusCode
    {
        return new MethodNotAllowedCode();
    }

    protected function flush(): void
    {
        header(sprintf('Allow: %s', $this->supportedRequestMethods->asString()));
    }
}
