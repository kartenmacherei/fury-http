<?php

declare(strict_types=1);
namespace Fury\Example;

class RelativePath extends Path
{
    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->ensureIsRelative($path);
        parent::__construct($path);
    }

    /**
     * @param string $path
     *
     * @throws NotARelativePathException
     */
    private function ensureIsRelative(string $path)
    {
        if (strpos($path, '/') === 0) {
            throw new NotARelativePathException();
        }
    }
}
