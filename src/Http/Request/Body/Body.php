<?php

declare(strict_types=1);
namespace Fury\Http;

use Fury\Application\ContentType;

abstract class Body
{
    /**
     * @param string $inputStream
     *
     * @throws UnsupportedRequestBodyException
     *
     * @return Body|JsonBody
     */
    public static function fromSuperGlobals(string $inputStream = 'php://input'): Body
    {
        $content = file_get_contents($inputStream);

        if (empty($content) && empty($_POST)) {
            return new EmptyBody();
        }

        if (!isset($_SERVER['CONTENT_TYPE']) || empty($_SERVER['CONTENT_TYPE'])) {
            return new RawBody($content);
        }

        switch ($_SERVER['CONTENT_TYPE']) {
            case ContentType::JSON:
            case ContentType::JSON_UTF8:
                return new JsonBody($content);
        }
        throw new UnsupportedRequestBodyException();
    }

    /**
     * @return bool
     */
    abstract public function isJson(): bool;
}
