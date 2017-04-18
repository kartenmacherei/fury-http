<?php

declare(strict_types=1);
namespace Fury\Http;

interface ResultRenderer
{
    public function render(): Response;
}
