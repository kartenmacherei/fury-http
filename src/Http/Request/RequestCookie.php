<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Request;

class RequestCookie
{
    /** @var string */
    private $name;

    /** @var string */
    private $value;

    /**
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
