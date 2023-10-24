<?php

declare(strict_types=1);

namespace Kartenmacherei\HttpFramework\Application\Result;

use Kartenmacherei\HttpFramework\Application\Response\NotFoundResponse;
use Kartenmacherei\HttpFramework\Http\Response\Response;
use Kartenmacherei\HttpFramework\Http\Result\ResultRenderer;

class NotFoundResultRenderer implements ResultRenderer
{
    /** @var NotFoundResult */
    private $result;

    /** @param NotFoundResult $result */
    public function __construct(NotFoundResult $result)
    {
        $this->result = $result;
    }

    /** @return Response */
    public function render(): Response
    {
        return new NotFoundResponse($this->result->getContent());
    }
}
