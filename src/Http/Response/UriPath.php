<?php
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
    public function asString():string
    {
        return $this->pathUri;
    }

    /**
     * @param string $pathUri
     *
     * @throws InvalidProductUriPathException
     */
    private function ensureStartsWithSlash($pathUri)
    {
        if ($pathUri[0] !== '/') {
            $message = sprintf('Expected path to start with "/", got path "%s"', $pathUri);
            throw new InvalidProductUriPathException($message);
        }
    }
}
