<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entity extends Model
{
    protected $table = 'entities';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'status',
        'type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
