<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Base extends Model
{
    use HasFactory;

    public static function loadFromRequest(Request $request, Bill $bill = null): self
    {
        if($bill==null) 
            $bill = new Bill();
        foreach ($bill->fillable as $i) {
            $bill->$i = $request->$i;
        }
        return $bill;
    }
}