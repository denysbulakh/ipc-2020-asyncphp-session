<?php
declare(strict_types=1);

namespace Bulakh\Infrastructure;
use Bulakh\Services\BookingService;
use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

class BookingServer
{
    public static function createBookingServerCmd()
    {
        $server = new Server("0.0.0.0", 8080);

        $server->on("start", function (Server $server) {
            echo "Swoole http server is started at http://0.0.0.0:8080\n";
        });

        $server->on("request", function (Request $request, Response $response) {
            $response->header("Content-Type", "application/json");
            BookingService::createBookingCmd($response);
        });

        $server->start();
    }
}
