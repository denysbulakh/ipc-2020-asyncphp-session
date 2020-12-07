<?php
declare(strict_types=1);

namespace Bulakh\Services;

require __DIR__ . '/../../vendor/autoload.php';

use Bulakh\Models\Booking;
use Bulakh\Models\Ticket;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;

class BookingService
{
    public static function createBookingPromise(LoopInterface $loop): Deferred
    {
        $deferred = new Deferred();
        $deferred->promise()
            ->then(function (Booking $booking) use ($deferred) {
                $booking->save();
                return $booking;
            });

        return $deferred;
    }

    public static function createBooking(Deferred $deferredBooking, LoopInterface $loop): void
    {
        $ticket = new Ticket();
        $booking = new Booking();
        $booking->setTicket($ticket);

        RegisterService::registerBooking($booking, $deferredBooking, $loop);
    }

    public static function createBookingCmd(): void
    {
        $timeMarker = microtime(true);

        $loop = Factory::create();
        $deferredBooking = self::createBookingPromise($loop);

        $deferredBooking->promise()->done(
            function (Booking $booking) use ($timeMarker) {
                echo json_encode([
                    'booking' => $booking->getInfo(),
                    'execution_time' => round(microtime(true) - $timeMarker, 3),
                ], JSON_PRETTY_PRINT);
            },
            function ($reason) {
                LoggingService::getLogger()->info("Booking failed", [$reason]);
            }
        );

        $loop->futureTick(function() use ($deferredBooking, $loop) {
            self::createBooking($deferredBooking, $loop);
        });

        $loop->run();
    }
}
