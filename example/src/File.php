<?php declare(strict_types=1);
namespace Fury\Example;

class File
{
    /**
     * @var Path
     */
    private $path;

    /**
     * @param Path $path
     */
    public function __construct(Path $path)
    {
        $this->ensureIsAFile($path);
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return file_get_contents($this->path->asString());
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return $this->path->exists();
    }

    /**
     * @return Path
     */
    public function getPath(): Path
    {
        return $this->path;
    }

    /**
     * @param Path $path
     * @throws NotAFileException
     */
    private function ensureIsAFile(Path $path)
    {
        if ($path->exists() && !$path->isFile()) {
            throw new NotAFileException();
        }
    }

}
