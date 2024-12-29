<?php

namespace App\Actions\Entities;

use App\Contracts\Entities\UpdateEntityContract;
use App\Models\Entity;

class UpdateEntityInformation implements UpdateEntityContract
{
    public function execute(int $entityId, array $entityData): bool
    {
        return Entity::findOrFail($entityId)->update($entityData);
    }
}
