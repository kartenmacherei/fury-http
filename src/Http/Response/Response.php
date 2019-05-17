<?php

declare(strict_types=1);
namespace Fury\Http\Response;

interface Response
{
    public function send(): void;

    public function addCookie(ResponseCookie $cookie): void;
}
