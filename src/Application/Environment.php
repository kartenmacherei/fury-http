<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application;

class Environment
{
    private const FURY_ENV = 'FURY_ENV';

    /** @var array */
    private $environmentVariables = [];

    public function __construct(array $environmentVariables)
    {
        $this->environmentVariables = $environmentVariables;
    }

    public static function fromSuperGlobals(): Environment
    {
        return new self($_SERVER);
    }

    public function isDevelopment(): bool
    {
        return array_key_exists(self::FURY_ENV, $this->environmentVariables) && $this->environmentVariables[self::FURY_ENV] === 'development';
    }
}
