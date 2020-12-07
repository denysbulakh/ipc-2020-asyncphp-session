<?php

declare(strict_types=1);

namespace Bulakh\Models;

use React\EventLoop\LoopInterface;
use React\ChildProcess\Process;
use React\EventLoop\TimerInterface;
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
        $cmd = 'composer register-async -- ' . $this->getTicketCode() . ' ' . $this->getProviderId();
        $process = new Process($cmd);
        $process->start($loop);

        $that = $this;
        $loop->addPeriodicTimer(
            0.5,
            function(TimerInterface $timer) use ($process, $taskDeferred, $loop, $that) {
                if (!$process->isRunning()) {
                    if ($process->getExitCode() === 0) {
                        $taskDeferred->resolve($that);
                    } else {
                        $taskDeferred->reject();
                    }
                    $loop->cancelTimer($timer);
                }
            }
        );
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
