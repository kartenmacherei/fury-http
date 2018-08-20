<?php

declare(strict_types=1);
namespace Fury\Application;

use Fury\Http\BaseResponse;
use Fury\Http\MethodNotAllowedCode;
use Fury\Http\StatusCode;
use Fury\Http\SupportedRequestMethods;

class MethodNotAllowedResponse extends BaseResponse
{
    /**
     * @var SupportedRequestMethods
     */
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
