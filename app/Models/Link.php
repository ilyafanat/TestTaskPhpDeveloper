<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'temporary_user_id',
        'token',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Define the inverse of the one-to-many relationship.
     * Each link belongs to one TemporaryUser.
     */
    public function temporaryUser(): BelongsTo
    {
        return $this->belongsTo(TemporaryUser::class);
    }
}
