<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Result;

use Kartenmacherei\HttpFramework\Http\Response\Response;

interface ResultRenderer
{
    public function render(): Response;
}
