<?php

namespace App\Actions\Entities;

use App\Contracts\Entities\SwitchEntityContract;
use Illuminate\Contracts\Auth\Authenticatable;

class SwitchEntity implements SwitchEntityContract
{
    public function execute(Authenticatable $user, int $entityId): bool
    {
        $user->current_entity_id = $entityId;

        return $user->save();
    }
}
