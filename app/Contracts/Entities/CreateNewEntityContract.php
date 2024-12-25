<?php

namespace App\Contracts\Entities;

use App\Models\Entity;
use Illuminate\Contracts\Auth\Authenticatable;

interface CreateNewEntityContract
{
    public function execute(Authenticatable $user, array $entityData): Entity;
}
