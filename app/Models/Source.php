<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Base
{
    public $fillable = [
        'kind',
        'name'
    ];

    public function bills(): HasMany
    {
        return $this->hasMany(Bills::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
