<?php

namespace Juekr\HomepageRedirect\Middleware;

use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomepageRedirectMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $actor = $request->getAttribute('actor');
        $path = $request->getUri()->getPath();

        if ($actor && !$actor->isGuest() && $path === '/') {
            return new RedirectResponse('/all');
        }

        return $handler->handle($request);
    }
}