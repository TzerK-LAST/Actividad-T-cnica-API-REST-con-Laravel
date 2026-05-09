<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DiscordService
{
    private string $webhookUrl;

    public function __construct()
    {
        $this->webhookUrl = config('services.discord.webhook_url');
    }

    public function sendError(string $endpoint, string $method, string $message, string $ip): void
    {
        $this->send([
            'embeds' => [[
                'title'       => '🚨 Error 500 en la API',
                'color'       => 15158332,
                'fields'      => [
                    ['name' => 'Endpoint', 'value' => $endpoint, 'inline' => true],
                    ['name' => 'Método',   'value' => $method,   'inline' => true],
                    ['name' => 'IP',       'value' => $ip,       'inline' => true],
                    ['name' => 'Error',    'value' => $message,  'inline' => false],
                ],
                'timestamp'   => now()->toIso8601String(),
            ]],
        ]);
    }

    public function sendRateLimit(string $endpoint, string $ip, int $intentos): void
    {
        $this->send([
            'embeds' => [[
                'title'  => '⚠️ Rate Limit Excedido',
                'color'  => 16776960,
                'fields' => [
                    ['name' => 'Endpoint',  'value' => $endpoint,           'inline' => true],
                    ['name' => 'IP',        'value' => $ip,                 'inline' => true],
                    ['name' => 'Intentos',  'value' => (string) $intentos,  'inline' => true],
                ],
                'timestamp' => now()->toIso8601String(),
            ]],
        ]);
    }

    private function send(array $payload): void
    {
        Http::post($this->webhookUrl, $payload);
    }
}