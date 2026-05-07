<?php

namespace Juekr\HomepageRedirect;

use Flarum\Extend;
use Juekr\HomepageRedirect\Middleware\HomepageRedirectMiddleware;

return [
    (new Extend\Middleware('forum'))
        ->add(HomepageRedirectMiddleware::class),
];