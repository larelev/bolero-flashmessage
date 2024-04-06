<?php

namespace Bolero\Plugins\FlashMessage\Middlewares;

use Bolero\Framework\Http\Request;
use Bolero\Framework\Http\Response;
use Bolero\Framework\Middleware\MiddlewareInterface;
use Bolero\Framework\Middleware\RequestHandlerInterface;
use Bolero\Plugins\FlashMessage\FlashMessageInterface;

readonly class FlashMessenger implements MiddlewareInterface
{

    public function __construct(
        private FlashMessageInterface $flashMessage
    ) {
    }

    /**
     * @throws \Exception
     */
    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        $request->setFlashMessage($this->flashMessage);

        return $requestHandler->handle($request);
    }
}
