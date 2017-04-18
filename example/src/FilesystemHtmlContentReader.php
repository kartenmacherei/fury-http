<?php declare(strict_types=1);
namespace Fury\Example;

use Fury\Http\HtmlContent;

class FilesystemHtmlContentReader implements HtmlContentReader
{
    /**
     * @var Directory
     */
    private $baseDirectory;

    /**
     * @param Directory $baseDirectory
     */
    public function __construct(Directory $baseDirectory)
    {
        $this->baseDirectory = $baseDirectory;
    }

    /**
     * @param Identifier $key
     * @return bool
     */
    public function has(Identifier $key): bool
    {
        return $this->baseDirectory->hasFile($this->getPath($key));
    }

    /**
     * @param Identifier $key
     * @return HtmlContent
     */
    public function read(Identifier $key): HtmlContent
    {
        return new HtmlContent(
            $this->baseDirectory->getFile($this->getPath($key))->getContent()
        );
    }

    /**
     * @param Identifier $key
     * @return RelativePath
     */
    private function getPath(Identifier $key): RelativePath
    {
        return new RelativePath($key->asString() . '.html');
    }

}
