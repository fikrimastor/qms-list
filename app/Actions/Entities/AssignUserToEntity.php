<?php

namespace App\Actions\Entities;

use App\Contracts\Entities\AssignUserToEntityContract;
use App\Models\Entity;

class AssignUserToEntity implements AssignUserToEntityContract
{
    public function execute(int $entityId, int $userId): bool
    {
        // TODO: Implement execute() method.
        $entity = Entity::firstOrFail($entityId);

        return $entity->users()->attach($userId);
    }

    public function executeMultipleEntities(array $entities, int $userId): bool
    {
        // TODO: Implement executeMultipleEntities() method.
    }

    public function executeMultipleUsers(int $entityId, array $users): bool
    {
        // TODO: Implement executeMultipleUsers() method.
    }
}
