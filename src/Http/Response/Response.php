<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Response;

interface Response
{
    public function send(): void;

    public function addCookie(ResponseCookie $cookie): void;
}
