<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\UnitTest\Http\Request;

use Kartenmacherei\HttpFramework\Http\Request\DeleteRequest;
use Kartenmacherei\HttpFramework\Http\Request\RequestCookieJar;
use Kartenmacherei\HttpFramework\Http\Request\UriPath;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\HttpFramework\Http\Request\DeleteRequest
 *
 * @uses \Kartenmacherei\HttpFramework\Http\Request\Request
 * @uses \Kartenmacherei\HttpFramework\Http\Request\UriPath
 */
class DeleteRequestTest extends TestCase
{
    public function testIsDeleteRequestReturnsTrue(): void
    {
        $request = new DeleteRequest([], new UriPath('/'), new RequestCookieJar());
        $this->assertTrue($request->isDeleteRequest());
    }
}
