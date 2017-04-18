<?php declare(strict_types=1);
namespace Fury\Example;

use Fury\ContentResult;
use Fury\Http\Query;
use Fury\Result;

class PdpQuery implements Query
{
    /**
     * @var HtmlContentReader
     */
    private $reader;

    /**
     * @var Identifier
     */
    private $identifier;

    /**
     * @param HtmlContentReader $reader
     * @param Identifier $identifier
     */
    public function __construct(HtmlContentReader $reader, Identifier $identifier)
    {
        $this->reader = $reader;
        $this->identifier = $identifier;
    }

    /**
     * @return Result
     */
    public function execute(): Result
    {
        return new ContentResult($this->reader->read($this->identifier));
    }


}
