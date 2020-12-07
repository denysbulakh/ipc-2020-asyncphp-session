<?php

declare(strict_types=1);

namespace Bulakh\Models;

class Ticket
{
    protected $code = null;

    public function __construct()
    {
        $this->code = uniqid("_TICKET_");
    }

    public function getCode(): ?string
    {
        return $this->code;
    }
}