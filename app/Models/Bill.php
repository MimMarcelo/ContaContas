<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Base
{
    public $fillable = [
        'kind',
        'name',
        'value',
        'entry',
    ];
    
    public function selected($value): string
    {
        return $this->kind==$value?"selected":"";
    }

    public static function getTotal(mixed $bills, string $kind = 'D'){
        return $bills->where("kind","=",$kind)->sum("value");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
