<?php
declare(strict_types=1);

namespace Bulakh\Infrastructure;

use Bulakh\Models\Provider;

class ProvidersRepository
{
    public static function getArray(): array
    {
        $providers = [];

        for ($i = 0; $i < 10; $i++) {
            $providers[] = new Provider();
        }

        return $providers;
    }
}