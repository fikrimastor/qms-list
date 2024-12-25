<?php

namespace App\Actions\Users;

use App\Contracts\Entities\CreateNewEntityContract;
use App\Models\Entity;
use Illuminate\Contracts\Auth\Authenticatable;

class UserCreateNewEntity implements CreateNewEntityContract
{
    public function execute(Authenticatable $user, array $entityData): Entity
    {
        $user->entities()->attach($entity = Entity::create($entityData));

        return $entity;
    }
}