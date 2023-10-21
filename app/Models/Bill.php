<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Bill extends Model
{
    use HasFactory;
    public $fillable = [
        'kind',
        'name',
        'value',
        'entry',
    ];
    
    public static function loadFromRequest(Request $request, Bill $bill = null): self
    {
        if($bill==null) 
            $bill = new Bill();
        foreach ($bill->fillable as $i) {
            $bill->$i = $request->$i;
        }
        return $bill;
    }

    public function selected($value): string
    {
        return $this->kind==$value?"selected":"";
    }
}
