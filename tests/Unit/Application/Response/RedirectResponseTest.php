<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\UnitTest\Application;

use Kartenmacherei\HttpFramework\Application\Response\RedirectResponse;
use Kartenmacherei\HttpFramework\Http\Domain;
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
     *
     * @dataProvider getTestData
     *
     * @param string $expectedRedirect ,
     * @param UriPath $uriPath
     * @param array $parameters
     * @param Domain|null $domain
     */
    public function testRedirect(
        string $expectedRedirect,
        UriPath $uriPath,
        array $parameters = null,
        Domain $domain = null
    ): void {
        $this->checkXdebugGetHeadersIsAvailableOrSkipTest();

        $uriPathString = '/foo/bar';

        $response = new RedirectResponse($uriPath, $parameters, $domain);
        $response->send();

        $header = xdebug_get_headers()[0];
        $this->assertSame($expectedRedirect, $header);
    }

    public function getTestData(): array
    {
        return [
            [
                'Location: /foo/bar',
                new UriPath('/foo/bar'),
                [],
            ],
            [
                'Location: /foo/bar?foo=1%262&bar=baz',
                new UriPath('/foo/bar'),
                ['foo' => '1&2', 'bar' => 'baz'],
            ],
            [
                'Location: https://kartenmacherei.de/foo/bar?foo=1%262&bar=baz',
                new UriPath('/foo/bar'),
                ['foo' => '1&2', 'bar' => 'baz'],
                new Domain('kartenmacherei.de'),
            ],
        ];
    }
}
