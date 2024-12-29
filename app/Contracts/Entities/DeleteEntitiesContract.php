<?php

namespace App\Contracts\Entities;

interface DeleteEntitiesContract
{
    public function execute(int $entityId): bool|null;
}