<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Http;

use Iterator;

class JsonArray implements Iterator
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return JsonArray|JsonObject
     */
    public function current()
    {
        $current = current($this->data);
        if (is_array($current)) {
            return new self($current);
        }
        if (is_object($current)) {
            return new JsonObject($current);
        }

        return $current;
    }

    public function next(): void
    {
        next($this->data);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return array_key_exists($this->key(), $this->data);
    }

    public function rewind(): void
    {
        reset($this->data);
    }
}
