<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Content;

class JsonContent implements Content
{
    /** @var string */
    private $jsonString;

    /**
     * @param mixed $data
     *
     * @throws EncodeException
     */
    public function __construct($data)
    {
        $encodedData = json_encode($data);
        if (false === $encodedData) {
            throw new EncodeException(
                sprintf('Data could not be encoded into JSON: %s', json_last_error_msg())
            );
        }
        $this->jsonString = $encodedData;
    }

    public function asString(): string
    {
        return $this->jsonString;
    }

    public function getContentType(): ContentType
    {
        return new JsonContentType();
    }
}
