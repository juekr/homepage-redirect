<?php

namespace Juekr\HomepageRedirect\Middleware;

use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class HomepageRedirectMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $actor = $request->getAttribute('actor');
        $path = $request->getUri()->getPath();

        // only real HTTP requests
        if ($path === '/' && $actor && !$actor->isGuest()) {    
        $response = new RedirectResponse('/all', 302);

        // prevent caching of redirect

        return $response
            ->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->withHeader('Pragma', 'no-cache');
        }

        return $handler->handle($request);
    }
}