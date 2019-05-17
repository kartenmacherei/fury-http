<?php

declare(strict_types=1);
namespace Fury\Application\UnitTests;

use Fury\Application\Response\RedirectResponse;
use Fury\Http\Request\UriPath;
use Fury\UnitTests\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fury\Application\Response\RedirectResponse
 */
class RedirectResponseTest extends TestCase
{
    use CheckXdebugAvailableTrait;

    /**
     * @runInSeparateProcess
     */
    public function testIfConstructorSetsCookie(): void
    {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();

        $uriPathString = '/foo/bar';
        $uriPath = new UriPath($uriPathString);

        $response = new RedirectResponse($uriPath);
        $response->send();

        $this->assertTrue(in_array(sprintf('Location: %s', $uriPathString), xdebug_get_headers(), true));
    }
}
