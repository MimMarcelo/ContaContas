<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Bill extends Base
{
  public $fillable = [
    'name',
    'value',
    'entry',
    'to',
    'from',
    'prev',
    'next',
  ];

  protected $currency = 0;

  public function selected($variable, $id): string
  {
    return $this->$variable == $id ? "selected" : "";
  }

  public static function getCCTotals(mixed $bills, string $kind = 'D')
  {
    $sources = [];
    foreach ($bills as $b) {
      if (!isset($sources[$b->to()->name])) $sources[$b->to()->name] = 0;
      if (!isset($sources[$b->from()->name])) $sources[$b->from()->name] = 0;
      $sources[$b->to()->name] = $sources[$b->to()->name] + $b->value;
      $sources[$b->from()->name] = $sources[$b->from()->name] - $b->value;
    }
    return $sources;
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function to(): Source
  {
    if (isset($this->to)) {
      if ($this->to instanceof Source) {
        return $this->to;
      }
      $this->to = Source::find($this->to);
      return $this->to;
    }
    return new Source(["name" => ""]);
  }

  public function from(): Source
  {
    if (isset($this->from)) {
      if ($this->from instanceof Source) {
        return $this->from;
      }
      $this->from = Source::find($this->from);
      return $this->from;
    }
    return new Source(["name" => ""]);
  }

  public function currency()
  {
    if (!$this->currency instanceof Currency) {
      if ($this->from()->currency_id > 0) {
        $this->currency = Currency::find($this->from()->currency_id);
      } elseif ($this->to()->currency_id > 0) {
        $this->currency = Currency::find($this->to()->currency_id);
      }
      else{
        $this->currency = DB::table("currencies")
        ->where("user_id", "=",Auth::user()->id)
        ->where("default", "=", "true")->first();
      }
    }
    return $this->currency;
  }
}
