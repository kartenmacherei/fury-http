<?php

declare(strict_types=1);
namespace Fury\Http;

class UriPath
{
    /**
     * @var string
     */
    private $pathUri;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->ensureStartsWithSlash($path);
        $this->pathUri = $path;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->pathUri;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public function startsWith(string $string): bool
    {
        return strpos($this->pathUri, $string) === 0;
    }

    /**
     * @param UriPath $uri
     *
     * @return bool
     */
    public function equals(UriPath $uri): bool
    {
        $path = parse_url($this->asString(), PHP_URL_PATH);
        $otherPath = parse_url($uri->asString(), PHP_URL_PATH);

        return $path === $otherPath;
    }

    /**
     * @param Pattern $pattern
     *
     * @return bool
     */
    public function matches(Pattern $pattern): bool
    {
        return preg_match($pattern->asString(), $this->pathUri) === 1;
    }

    /**
     * @param string $pathUri
     *
     * @throws InvalidUriPathException
     */
    private function ensureStartsWithSlash(string $pathUri)
    {
        if ($pathUri[0] !== '/') {
            $message = sprintf('Expected path to start with "/", got path "%s"', $pathUri);
            throw new InvalidUriPathException($message);
        }
    }
}
