<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Response\RedirectResponse;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use Kartenmacherei\HttpFramework\UnitTest\Helper\CheckXdebugAvailableTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Application\Response\RedirectResponse
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
