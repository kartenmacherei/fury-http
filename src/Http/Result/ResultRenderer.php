<?php

declare(strict_types=1);
namespace Fury\Http\Result;

use Fury\Http\Response\Response;

interface ResultRenderer
{
    public function render(): Response;
}
