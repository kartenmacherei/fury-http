<?php declare(strict_types=1);
namespace Fury;

class Environment
{
    /**
     * @return bool
     */
    public function isDevelopment(): bool
    {
        // TODO super-fury isset($_SERVER['FURY_ENV']) && $_SERVER['FURY_ENV'] === 'development'
        return true;
    }
}
