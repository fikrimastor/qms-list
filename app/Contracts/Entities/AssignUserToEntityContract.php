<?php

namespace App\Contracts\Entities;

interface AssignUserToEntityContract
{
    public function execute(int $entityId, int $userId): bool;

    public function executeMultipleEntities(array $entities, int $userId): bool;

    public function executeMultipleUsers(int $entityId, array $users): bool;
}