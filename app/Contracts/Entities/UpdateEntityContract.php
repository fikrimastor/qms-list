<?php

namespace App\Contracts\Entities;

interface UpdateEntityContract
{
    public function execute(int $entityId, array $entityData): bool;
}