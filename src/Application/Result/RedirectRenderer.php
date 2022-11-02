<?php

declare(strict_types=1);
namespace Kartenmacherei\HttpFramework\Application\Result;

use Kartenmacherei\HttpFramework\Application\Response\RedirectResponse;
use Kartenmacherei\HttpFramework\Http\Response\Response;
use Kartenmacherei\HttpFramework\Http\Result\ResultRenderer;

class RedirectRenderer implements ResultRenderer
{
    /** @var RedirectResult */
    private $result;

    public function __construct(RedirectResult $result)
    {
        $this->result = $result;
    }

    public function render(): Response
    {
        return new RedirectResponse(
            $this->result->getUriPath(),
            $this->result->getParameters(),
            $this->result->getDomain()
        );
    }
}
