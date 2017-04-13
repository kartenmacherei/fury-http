<?php declare(strict_types=1);
namespace Frontend;

use Frontend\Http\Response;

interface ResultRenderer
{
    public function render(): Response;
}
