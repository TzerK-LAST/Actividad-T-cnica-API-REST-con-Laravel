<?php

namespace App\Http\Middleware;

use App\Services\DiscordService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;

class RateLimitDiscordAlert
{
    public function __construct(
        private DiscordService $discord,
        private RateLimiter $limiter
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $key      = $request->ip();
        $intentos = $this->limiter->attempts('api:' . $key);

        if ($intentos > 10) {
            $this->discord->sendRateLimit(
                $request->path(),
                $request->ip(),
                $intentos
            );
        }

        return $next($request);
    }
}