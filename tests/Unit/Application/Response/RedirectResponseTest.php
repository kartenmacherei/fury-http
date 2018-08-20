<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\RedirectResponse;
use Fury\Http\UriPath;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\RedirectResponse
 */
class RedirectResponseTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    /**
     * @runInSeparateProcess
     */
    public function testIfConstructorSetsCookie()
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();

        $uriPathString = '/foo/bar';
        $uriPath = new UriPath($uriPathString);

        $response = new RedirectResponse($uriPath);
        $response->send();

        $this->assertTrue(in_array(sprintf('Location: %s', $uriPathString), xdebug_get_headers(), true));
    }
}
