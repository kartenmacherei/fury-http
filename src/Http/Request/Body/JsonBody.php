<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Http\Request\Body;

use Kartenmacherei\HttpFramework\Http\EnsureException;
use Kartenmacherei\HttpFramework\Http\JsonArray;
use Kartenmacherei\HttpFramework\Http\JsonObject;

class JsonBody extends Body
{
    /** @var JsonObject|JsonArray */
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

    /** @return JsonArray|JsonObject */
    public function getJson()
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
     * @return JsonObject|JsonArray
     */
    private function decode(string $jsonString)
    {
        $decoded = json_decode($jsonString, false);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new EnsureException(sprintf('JSON body could not be decoded: %s', json_last_error_msg()));
        }

        if (is_array($decoded)) {
            return new JsonArray($decoded);
        }

        return new JsonObject($decoded);
    }
}
