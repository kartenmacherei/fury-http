<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Request\Body;

use Kartenmacherei\HttpFramework\Http\EnsureException;
use Kartenmacherei\HttpFramework\Http\JsonArray;
use Kartenmacherei\HttpFramework\Http\JsonObject;

class JsonBody extends Body
{
    /** @var JsonObject */
    private $json;

    /** @var string */
    private $jsonString = '';

    /** @param string $jsonString */
    public function __construct(string $jsonString)
    {
        $this->json = $this->decode($jsonString);
        $this->jsonString = $jsonString;
    }

    /**
     * @param string $selector
     *
     * @return JsonArray|JsonObject|string|int
     */
    public function query(string $selector)
    {
        return $this->json->query($selector);
    }

    public function getJson(): JsonObject
    {
        return $this->json;
    }

    public function getEncodedString(): string
    {
        return $this->jsonString;
    }

    /**
     * @param string $jsonString
     *
     * @throws EnsureException
     *
     * @return JsonObject
     */
    private function decode(string $jsonString): JsonObject
    {
        $decoded = json_decode($jsonString, false);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new EnsureException(sprintf('JSON body could not be decoded: %s', json_last_error_msg()));
        }

        return new JsonObject($decoded);
    }
}
