<?php
declare(strict_types=1);

namespace Bulakh\Services;

require __DIR__ . '/../../vendor/autoload.php';

use Bulakh\Models\Booking;
use Bulakh\Models\Ticket;
use React\Promise\Deferred;

class BookingService
{
    public static function createBookingPromise(): Deferred
    {
        $deferred = new Deferred();
        $deferred->promise()
            ->then(function (Booking $booking) use ($deferred) {
                $ticket = new Ticket();
                $booking->setTicket($ticket);
                return $booking;
            })
            ->then(function (Booking $booking) use ($deferred) {
                RegisterService::registerBooking($booking);
                return $booking;
            })
            ->then(function (Booking $booking) use ($deferred) {
                $booking->save();
                return $booking;
            });

        return $deferred;
    }

    public static function createBooking(Deferred $deferredBooking): void
    {
        $booking = new Booking();
        $deferredBooking->resolve($booking);
    }

    public static function createBookingCmd(): void
    {
        $timeMarker = microtime(true);

        $deferredBooking = self::createBookingPromise();

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

        self::createBooking($deferredBooking);
    }
}
