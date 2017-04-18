<?php declare(strict_types=1);
namespace Fury\Example;

class Directory
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
        $this->ensureIsADirectory($path);
        $this->path = $path;
    }

    /**
     * @param RelativePath $path
     * @return bool
     */
    public function hasFile(RelativePath $path): bool
    {
        return $this->getFile($path)->exists();
    }

    /**
     * @param RelativePath $path
     * @return File
     */
    public function getFile(RelativePath $path): File
    {
        return new File($this->path->getChild($path));
    }

    /**
     * @param Path $path
     * @throws NotADirectoryException
     */
    private function ensureIsADirectory(Path $path)
    {
        if ($path->exists() && !$path->isDirectory()) {
            throw new NotADirectoryException();
        }
    }
}
