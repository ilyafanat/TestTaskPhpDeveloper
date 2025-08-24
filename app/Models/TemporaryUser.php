<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemporaryUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'phone_number',
    ];

    protected $casts = [];

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }
}
