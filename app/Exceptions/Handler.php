<?php

namespace App\Exceptions;

use App\Services\DiscordService;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Sentry
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }

            // Discord
            try {
                $request = request();
                app(DiscordService::class)->sendError(
                    $request->path(),
                    $request->method(),
                    $e->getMessage(),
                    $request->ip()
                );
            } catch (\Exception $discordError) {
                \Log::error('Discord error: ' . $discordError->getMessage());
            }
        });
    }
}