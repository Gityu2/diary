<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DayLike extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function day()
    {
      return $this->belongsTo(day::class);
    }
}
