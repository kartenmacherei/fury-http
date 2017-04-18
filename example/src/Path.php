<?php declare(strict_types=1);
namespace Fury\Example;

class Path
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->ensureDoesNotContainControlCharacters($path);
        $this->path = rtrim($path, '/');
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->path;
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return file_exists($this->path);
    }

    /**
     * @return bool
     */
    public function isDirectory(): bool
    {
        return is_dir($this->path);
    }

    /**
     * @return bool
     */
    public function isFile(): bool
    {
        return is_file($this->path);
    }

    /**
     * @param RelativePath $path
     * @return Path
     */
    public function getChild(RelativePath $path): Path
    {
        return new self($this->path . '/' . $path->asString());
    }

    /**
     * @param string $path
     * @throws InvalidPathException
     */
    private function ensureDoesNotContainControlCharacters(string $path)
    {
        if (preg_match('/[[:cntrl:]]/', $path)) {
            throw new InvalidPathException();
        }
    }
}
