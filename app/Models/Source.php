<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Source extends Base
{
    public $fillable = [
        'name',
        'code',
        'group',
        'currency_id',
        'cc',
        'resume'
    ];

    // public function bills(): HasMany
    // {
    //     return $this->hasMany(Bills::class);
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function sources($user_id)
    {
        return DB::table("sources")
                ->where("user_id", "=", $user_id)
                ->orderByDesc("cc")
                ->orderBy("group")
                ->orderBy("name")
                ->get();
    }

    // public static function kinds($user_id)
    // {
    //     return DB::table("sources")
    //             ->select("kind")
    //             ->where("user_id", "=", $user_id)
    //             ->distinct()
    //             ->orderBy("kind")
    //             ->get();
    // }
}
