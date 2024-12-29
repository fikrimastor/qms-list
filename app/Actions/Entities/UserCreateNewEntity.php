<?php

namespace App\Actions\Entities;

use App\Contracts\Entities\CreateNewEntityContract;
use App\Models\Entity;
use Illuminate\Contracts\Auth\Authenticatable;

class UserCreateNewEntity implements CreateNewEntityContract
{
    public function execute(Authenticatable $user, array $entityData): Entity
    {
        $user->entities()->attach($entity = Entity::create($entityData));

        $user->current_entity_id = $entity->id;

        $user->save();

        return $entity;
    }
}
