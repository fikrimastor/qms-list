<?php

namespace App\Contracts\Entities;

use Illuminate\Contracts\Auth\Authenticatable;

interface SwitchEntityContract
{
    public function execute(Authenticatable $user, int $entityId): bool;
}
