<?php

declare(strict_types=1);
namespace Fury\Application\Response;

use Fury\Http\Request\SupportedRequestMethods;
use Fury\Http\Response\BaseResponse;
use Fury\Http\Response\StatusCode;
use Fury\Http\Response\StatusCode\MethodNotAllowedCode;

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
