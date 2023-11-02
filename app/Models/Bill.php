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
        'to',
        'from',
    ];
    
    public function selected($value): string
    {
        return $this->kind==$value?"selected":"";
    }

    public function toSelected($value): string
    {
        return $this->to==$value?"selected":"";
    }

    public static function getTotal(mixed $bills, string $kind = 'D'){
        return $bills->where("kind","=",$kind)->sum("value");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function to(): Source
    {
        if(isset($this->to)){
            if($this->to instanceof Source){
                return $this->to;
            }
            return Source::find($this->to);
        }
        return new Source(["name" => ""]);
    }

    public function from(): Source
    {
        if(isset($this->from)){
            if($this->from instanceof Source){
                return $this->from;
            }
            return Source::find($this->from);
        }
        return new Source(["name" => ""]);

    }
}
