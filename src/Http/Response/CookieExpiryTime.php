<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Response;

use DateTimeImmutable;
use DateTimeZone;

class CookieExpiryTime extends DateTimeImmutable
{
    public function __construct(string $time = 'now')
    {
        parent::__construct($time, new DateTimeZone('UTC'));
    }
}
