<?php

declare(strict_types=1);

namespace Bulakh\Models;

use Bulakh\Infrastructure\RegisterRequest;

class Provider
{
    protected $id = null;

    public function __construct()
    {
        $this->id = uniqid("_PROVIDER_");
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}