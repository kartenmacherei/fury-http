<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Request;

use Kartenmacherei\HttpFramework\Http\EnsureException;

class SupportedRequestMethods
{
    private const HTTP_METHODS = [
        'GET', 'POST', 'HEAD', 'PUT', 'PATCH', 'DELETE', 'TRACE', 'OPTIONS', 'CONNECT',
    ];

    /** @var array */
    private $methods;

    public function __construct(string ...$methods)
    {
        array_walk(
            $methods,
            function (&$item, $key): void {
                $item = strtoupper($item);
            }
        );
        $this->ensureValidMethods($methods);
        $this->methods = $methods;
    }

    public function asString(): string
    {
        return implode(', ', $this->methods);
    }

    private function ensureValidMethods(array $methods): void
    {
        if (empty($methods) || !empty(array_diff($methods, self::HTTP_METHODS))) {
            throw new EnsureException('invalid http method provided');
        }
    }
}
