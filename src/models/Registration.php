<?php

declare(strict_types=1);

namespace Bulakh\Models;

use Bulakh\Infrastructure\RegisterRequest;

class Registration
{
    protected $provider = null;
    protected $booking = null;

    public function __construct(Booking $booking, Provider $provider)
    {
        $this->booking = $booking;
        $this->provider = $provider;
    }

    public function register(): bool
    {
        return RegisterRequest::send($this->getTicketCode(), $this->getProviderId());
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
