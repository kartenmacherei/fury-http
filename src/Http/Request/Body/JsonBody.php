<?php

declare(strict_types=1);
namespace Fury\Http;

class JsonBody extends Body
{
    /**
     * @var JsonObject
     */
    private $json;

    /**
     * @var string
     */
    private $jsonString = '';

    /**
     * @param string $jsonString
     */
    public function __construct(string $jsonString)
    {
        $this->json = $this->decode($jsonString);
        $this->jsonString = $jsonString;
    }

    /**
     * @return bool
     */
    public function isJson(): bool
    {
        return true;
    }

    /**
     * @param string $selector
     *
     * @return JsonArray|JsonObject|string|mixed
     */
    public function query(string $selector): mixed
    {
        return $this->json->query($selector);
    }

    /**
     * @return JsonObject
     */
    public function getJson(): JsonObject
    {
        return $this->json;
    }

    /**
     * @return string
     */
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
