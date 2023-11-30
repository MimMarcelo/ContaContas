<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Currency extends Base
{
    public $fillable = [
        'name',
        'code',
        'default'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
