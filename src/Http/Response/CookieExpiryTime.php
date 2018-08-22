<?php

declare(strict_types=1);
namespace Fury\Http;

use DateTimeImmutable;
use DateTimeZone;

class CookieExpiryTime extends DateTimeImmutable
{
    public function __construct(string $time = 'now')
    {
        $greenwichMeanTime = new DateTimeZone('UTC');
        parent::__construct($time, $greenwichMeanTime);
    }
}
