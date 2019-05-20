<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http\Request\Body;

class RawBody extends Body
{
    /**
     * @var string
     */
    private $content = '';

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
