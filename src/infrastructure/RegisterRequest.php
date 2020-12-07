<?php
declare(strict_types=1);

namespace Bulakh\Infrastructure;

use Composer\Script\Event;

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

    public static function asyncSend(Event $event): void
    {
        self::send($event->getArguments()[0], $event->getArguments()[1]) ? exit(0) : exit(1);
    }
}
