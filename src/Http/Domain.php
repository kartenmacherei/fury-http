<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http;

class Domain
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidDomain($value);
        $this->value = $value;
    }

    public function asString(): string
    {
        return $this->value;
    }

    private function ensureIsValidDomain(string $value): void
    {
        if (preg_match('/^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/', $value) !== 1) {
            throw new InvalidDomainException(sprintf('%s is not a valid domain', $value));
        }
    }
}
