<?php

declare(strict_types=1);
namespace Fury\Http;

interface Response
{
    public function send(): void;

    public function addCookie(ResponseCookie $cookie): void;
}
