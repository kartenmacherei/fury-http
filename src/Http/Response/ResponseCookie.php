<?php

declare(strict_types=1);
namespace Fury\Http;

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
     * @var CookieExpiryTime|null
     */
    private $expiresAt;

    /**
     * @var string|null
     */
    private $domain;

    private const EXPIRE_END_OF_SESSION = 0;
    private const ROOT_WITH_ALL_SUBDIRECTORIES = '/';
    private const NO_DOMAIN = '';
    private const HTTPS_ONLY = true;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function send(): void
    {
        $result = setcookie(
            $this->name,
            $this->value,
            $this->hasExpiryDate() ? $this->expiresAt->getTimestamp() : self::EXPIRE_END_OF_SESSION,
            self::ROOT_WITH_ALL_SUBDIRECTORIES,
            $this->hasDomain() ? $this->domain : self::NO_DOMAIN,
            self::HTTPS_ONLY,
            $this->isHttpOnly
        );
        //@codeCoverageIgnoreStart
        if ($result === false) {
            $msg = sprintf(
                'Sending cookie failed. [name=%s;value=%s;expire=%s;path=%s;domain=%s;secure=%s;httponly=%s;]',
                $this->name,
                $this->value,
                $this->hasExpiryDate() ? $this->expiresAt->getTimestamp() : self::EXPIRE_END_OF_SESSION,
                self::ROOT_WITH_ALL_SUBDIRECTORIES,
                $this->hasDomain() ? $this->domain : 'no domain',
                self::HTTPS_ONLY,
                $this->isHttpOnly
            );

            throw new Exception($msg);
        }
        //@codeCoverageIgnoreEnd
    }

    public function allowClientAccess(): void
    {
        $this->isHttpOnly = false;
    }

    public function expiresAt(CookieExpiryTime $dateTime): void
    {
        $this->expiresAt = $dateTime;
    }

    public function forDomain(string $domain): void
    {
        $this->ensureNotEmptyString($domain);
        $this->domain = $domain;
    }

    private function ensureNotEmptyString(string $domain): void
    {
        if ($domain === '') {
            throw new EnsureException('empty domain');
        }
    }

    private function hasExpiryDate(): bool
    {
        return $this->expiresAt !== null;
    }

    private function hasDomain(): bool
    {
        return $this->domain !== null;
    }
}
