<?php declare(strict_types=1);
namespace Fury;

use Fury\Http\Response;

interface ResultRenderer
{
    public function render(): Response;
}
