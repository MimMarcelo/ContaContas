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

    public static function loadFromRequest(Request $request, mixed $object = null): self
    {
        if($object==null) {
            $className = get_called_class();
            $object = new $className();
        }
        foreach ($object->fillable as $i) {
            $object->$i = $request->$i;
        }
        return $object;
    }
}