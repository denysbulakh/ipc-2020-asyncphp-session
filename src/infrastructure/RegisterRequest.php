<?php
declare(strict_types=1);

namespace Bulakh\Infrastructure;

use Bulakh\Services\LoggingService;

class RegisterRequest
{
    public static function send(string $ticketCode, string $providerId): void
    {
        do {
            $result = boolval(rand(0, 1));
            if ($result) {
                LoggingService::getLogger()->info("Registered", [$ticketCode, $providerId]);
            } else {
                LoggingService::getLogger()->info("Failed", [$ticketCode, $providerId]);
            }
        } while (!$result);
    }
}