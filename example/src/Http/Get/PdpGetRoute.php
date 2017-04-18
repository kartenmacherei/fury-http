<?php declare(strict_types=1);
namespace Fury\Example;

use Fury\Http\GetRequest;
use Fury\Http\GetRoute;
use Fury\Http\Query;

class PdpGetRoute extends GetRoute
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
     */
    public function __construct(HtmlContentReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param GetRequest $request
     * @return bool
     */
    protected function canRoute(GetRequest $request): bool
    {
        $this->identifier = new Identifier(ltrim($request->getPath()->asString(), '/'));
        return $this->reader->has($this->identifier);
    }

    /**
     * @param GetRequest $request
     * @return Query
     */
    protected function getQuery(GetRequest $request): Query
    {
        return new PdpQuery($this->reader, $this->identifier);
    }

}
