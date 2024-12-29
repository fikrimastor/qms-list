<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserEntity extends Pivot
{
    protected $table = 'user_entities';
}
