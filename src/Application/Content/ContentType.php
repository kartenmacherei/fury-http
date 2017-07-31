<?php

declare(strict_types=1);
namespace Fury\Application;

abstract class ContentType
{
    const JSON = 'application/json';
    const JSON_UTF8 = 'application/json; charset=UTF-8';
    const PLAIN = 'text/plain';

    /**
     * @param $type
     *
     * @throws UnsupportedContentTypeException
     *
     * @return ContentType
     */
    public static function fromString($type): ContentType
    {
        switch ($type) {
            case self::JSON:
            case self::JSON_UTF8:
                return new JsonContentType();
            case self::PLAIN:
                return new PlainContentType();
        }
        throw new UnsupportedContentTypeException(sprintf('Content type %s is not supported', $type));
    }

    /**
     * @return string
     */
    abstract public function asString(): string;
}
