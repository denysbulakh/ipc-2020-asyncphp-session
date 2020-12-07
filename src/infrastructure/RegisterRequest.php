<?php
declare(strict_types=1);

namespace Bulakh\Infrastructure;

class RegisterRequest
{
    public static function send(string $ticketCode, string $providerId): bool
    {
        $tries = 0;

        do {
            $tries++;
            $result = rand(0, 5);
        } while ($result !== 1 && $tries < 5);

        return $result === 1;
    }
}
