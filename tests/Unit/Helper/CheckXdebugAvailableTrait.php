<?php

declare(strict_types=1);
namespace Fury\UnitTests\Helper;

trait CheckXdebugAvailableTrait
{
    public function checkXdebugGetHeadersIsAvailableOrSkipTest(): void
    {
        if (!function_exists('xdebug_get_headers')) {
            $this->markTestSkipped('This test requires xdebug_get_headers() from the XDEBUG-Extension.');
        }
    }
}
