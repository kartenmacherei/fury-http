<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Response;

use Kartenmacherei\HttpFramework\Http\Exception;

class DeletionResponseCookie extends ResponseCookie
{
    private const VALUE_TO_REMOVE = 'deleted';

    private const TIME_IN_THE_PAST = '1970-01-01 00:00:01';

    public function __construct(string $name)
    {
        parent::__construct($name, self::VALUE_TO_REMOVE);
        $this->setExpiryDate(new CookieExpiryTime(self::TIME_IN_THE_PAST));
    }

    public function expiresAt(CookieExpiryTime $dateTime): void
    {
        throw new Exception('not allowed');
    }
}
