<?php

declare(strict_types=1);
namespace Fury\Http;

class UriPath
{
    /**
     * @var string
     */
    private $pathUri;

    public function __construct(string $path)
    {
        $this->ensureStartsWithSlash($path);
        $this->pathUri = $path;
    }

    public function asString(): string
    {
        return $this->pathUri;
    }

    public function asStringWithoutTrailingSlash(): string
    {
        return rtrim($this->pathUri, '/');
    }

    public function startsWith(string $string): bool
    {
        return strpos($this->pathUri, $string) === 0;
    }

    public function equals(UriPath $uri): bool
    {
        $path = parse_url($this->asString(), PHP_URL_PATH);
        $otherPath = parse_url($uri->asString(), PHP_URL_PATH);

        return $path === $otherPath;
    }

    public function matches(Pattern $pattern): bool
    {
        return preg_match($pattern->asString(), $this->pathUri) === 1;
    }

    /**
     * @param string $pathUri
     *
     * @throws InvalidUriPathException
     */
    private function ensureStartsWithSlash(string $pathUri): void
    {
        if ($pathUri[0] !== '/') {
            $message = sprintf('Expected path to start with "/", got path "%s"', $pathUri);
            throw new InvalidUriPathException($message);
        }
    }
}
