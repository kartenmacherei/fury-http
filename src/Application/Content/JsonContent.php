<?php declare(strict_types=1);

namespace Fury\Application;
class JsonContent implements Content
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param mixed $data
     * @throws ContentException
     */
    public function __construct($data)
    {
        $encodedData = json_encode($data);
        if (false === $encodedData) {
            throw new ContentException(
                sprintf('Data could not be encoded into JSON: %s', json_last_error_msg())
            );
        }
        $this->content = $encodedData;
    }



    public function asString(): string
    {
        return $this->content;
    }

    public function getContentType(): ContentType
    {
        return new JsonContentType();
    }

}
