<?php

namespace Diadal\Google2FALaravel;

use Closure;
use Diadal\Google2FALaravel\Support\Authenticator;

class Middleware
{
    public function handle($request, Closure $next)
    {
        $authenticator = app(Authenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }

        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}
