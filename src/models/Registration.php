<?php

declare(strict_types=1);

namespace Bulakh\Models;

use Bulakh\Infrastructure\RegisterRequest;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;

class Registration
{
    protected $provider = null;
    protected $booking = null;

    public function __construct(Booking $booking, Provider $provider)
    {
        $this->booking = $booking;
        $this->provider = $provider;
    }

    public function register(LoopInterface $loop, Deferred $taskDeferred): void
    {
        \Swoole\Runtime::enableCoroutine();
        $that = $this;

        go(function() use ($taskDeferred, $that) {
            if (RegisterRequest::send($that->getTicketCode(), $that->getProviderId())) {
                $taskDeferred->resolve($that);
            } else {
                $taskDeferred->reject();
            }
        });
    }

    public function getTicketCode(): string
    {
        if (!is_null($this->booking)) {
            return $this->booking->getTicket()->getCode();
        }

        return '';
    }

    public function getProviderId(): string
    {
        return $this->provider->getId();
    }
}
