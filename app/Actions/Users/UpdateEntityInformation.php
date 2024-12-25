<?php

namespace App\Actions\Users;

use App\Contracts\Entities\UpdateEntityContract;
use App\Models\Entity;

class UpdateEntityInformation implements UpdateEntityContract
{

    public function execute(int $entityId, array $entityData): bool
    {
        // TODO: Implement execute() method.

        return Entity::firstOrFail($entityId)->update($entityData);
    }
}