<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Request;

use Kartenmacherei\HttpFramework\Http\CookieNotFoundException;

class RequestCookieJar
{
    /** @var RequestCookie[] */
    private $cookies = [];

    public static function fromSuperGlobals(): RequestCookieJar
    {
        $jar = new RequestCookieJar();
        foreach ($_COOKIE as $name => $value) {
            $jar->addCookie(new RequestCookie($name, $value));
        }

        return $jar;
    }

    public function hasCookie($name): bool
    {
        return array_key_exists($name, $this->cookies);
    }

    public function getCookie($name): RequestCookie
    {
        if (!$this->hasCookie($name)) {
            throw new CookieNotFoundException(sprintf('Cookie %s not found', $name));
        }

        return $this->cookies[$name];
    }

    private function addCookie(RequestCookie $cookie): void
    {
        $this->cookies[$cookie->getName()] = $cookie;
    }
}
