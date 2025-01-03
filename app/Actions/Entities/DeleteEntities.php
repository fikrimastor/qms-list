<?php

namespace App\Actions\Entities;

use App\Contracts\Entities\DeleteEntitiesContract;
use App\Models\Entity;
use App\Models\User;

class DeleteEntities implements DeleteEntitiesContract
{
    /**
     * Delete the entity
     */
    public function execute(int $entityId): ?bool
    {
        $entity = Entity::findOrFail($entityId);

        User::where('current_entity_id', $entity->id)->update(['current_entity_id' => null]);

        $entity->users()->detach();

        return $entity->delete();
    }
}
