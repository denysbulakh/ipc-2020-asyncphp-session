<?php
declare(strict_types=1);

namespace Bulakh\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggingService
{
    public static $logger = null;

    public static function getLogger(): Logger
    {
        if (is_null(self::$logger)) {
            self::$logger = new Logger('bulakh');
            self::$logger->pushHandler(new StreamHandler('logs/info.log', Logger::INFO));
        }

        return self::$logger;
    }
}