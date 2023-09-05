<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Request;

class UriPath
{
    /** @var string */
    private $pathUri;

    public function __construct(string $path)
    {
        $this->ensureStartsWithSlash($path);
        $this->ensureNoDoubleStartingSlash($path);
        $this->pathUri = parse_url($path, PHP_URL_PATH);
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
        return str_starts_with($this->pathUri, $string);
    }

    public function equals(UriPath $uri): bool
    {
        $path = $this->asString();
        $otherPath = $uri->asString();

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

    private function ensureNoDoubleStartingSlash(string $pathUri): void
    {
        if (str_starts_with($pathUri, '//')) {
            $message = sprintf('Expected path to start with "/", got path "%s"', $pathUri);
            throw new InvalidUriPathException($message);
        }
    }
}
