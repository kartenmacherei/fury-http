<?php

declare(strict_types=1);
namespace Fury\Example;

use Fury\Http\GetRouter;

class Factory extends \Fury\Application\Factory
{
    /**
     * @return Application
     */
    public function createApplication(): Application
    {
        return new Application($this);
    }

    /**
     * @return GetRouter
     */
    public function createGetRouter(): GetRouter
    {
        return new GetRouter();
    }

    /**
     * @return PdpGetRoute
     */
    public function createPdpRoute(): PdpGetRoute
    {
        return new PdpGetRoute($this->createFilesystemHtmlContentReader());
    }

    /**
     * @return FilesystemHtmlContentReader
     */
    private function createFilesystemHtmlContentReader(): FilesystemHtmlContentReader
    {
        return new FilesystemHtmlContentReader(new Directory(new Path(__DIR__ . '/../static')));
    }
}
