<?php

declare(strict_types=1);
namespace Fury\Http;

use DateTime;
use DateTimeImmutable;

class ResponseCookie
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var bool
     */
    private $isHttpOnly = true;

    /**
     * @var DateTimeImmutable|null
     */
    private $expiresAt;

    /**
     * @var string|null
     */
    private $domain;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function send()
    {
        $cookieDirectives = [
            sprintf('%s=%s', $this->name, rawurlencode($this->value)),
            'Path=/',
            'Secure',
        ];
        if ($this->domain !== null) {
            $cookieDirectives[] = sprintf('Domain=%s', $this->domain);
        }
        if ($this->isHttpOnly) {
            $cookieDirectives[] = 'HttpOnly';
        }
        if ($this->expiresAt !== null) {
            $cookieDirectives[] = 'Expires=' . $this->expiresAt->format(DateTime::COOKIE);
        }
        header(sprintf('Set-Cookie: %s', implode('; ', $cookieDirectives)), false);
    }

    public function allowClientAccess()
    {
        $this->isHttpOnly = false;
    }

    public function expiresAt(DateTimeImmutable $dateTime)
    {
        $this->expiresAt = $dateTime;
    }

    public function forDomain(string $domain): void
    {
        $this->domain = $domain;
    }
}
