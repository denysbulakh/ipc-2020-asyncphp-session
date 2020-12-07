<?php
declare(strict_types=1);

namespace Bulakh\Services;

require __DIR__ . '/../../vendor/autoload.php';

use Bulakh\Models\Booking;
use Bulakh\Models\Provider;
use Bulakh\Infrastructure\ProvidersRepository;
use Bulakh\Models\Registration;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\EventLoop\Factory;

class RegisterService
{
    public static function registerBooking(Booking $booking, Deferred $deferred, LoopInterface $loop)
    {
        $pendingRegistrationTasks = [];

        /** @var Provider $provider */
        foreach (ProvidersRepository::getArray() as $provider) {
            $taskDeferred = new Deferred();
            $taskDeferred->promise()
                ->done(
                    function() use ($booking, $provider, $deferred) {
                        $booking->addProvider($provider);
                        LoggingService::getLogger()
                            ->info("Registered", [$booking->getBookingNumber(), $provider->getId()]);
                    },
                    function() use ($booking, $provider, $deferred) {
                        LoggingService::getLogger()
                            ->info("Registration failed", [$booking->getBookingNumber(), $provider->getId()]);
                    }
                );

            $pendingRegistrationTasks[] = $taskDeferred;

            $registration = new Registration($booking, $provider);
            $registration->register($loop, $taskDeferred);
        }

        $promiseAny = \React\Promise\any(array_map(function(Deferred $item) {
            return $item->promise();
        }, $pendingRegistrationTasks));

        $promiseAny->then(function() use ($booking, $deferred) {
            $deferred->resolve($booking);
        });

    }
}
