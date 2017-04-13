<?php declare(strict_types=1);
namespace Frontend;

use Frontend\Http\BaseResponse;
use Frontend\Http\StatusCode\MethodNotAllowedCode;
use Frontend\Http\StatusCode\StatusCode;

class UnsupportedRequestTypeResponse extends BaseResponse
{
    /**
     * @return StatusCode
     */
    public function getStatusCode(): StatusCode
    {
        return new MethodNotAllowedCode();
    }

    protected function flush()
    {
        echo 'Method Not Allowed';
    }
}
