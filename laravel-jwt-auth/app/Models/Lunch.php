<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    use HasFactory;
    public function DailyDiet()
    {
        return $this->belongsToMany(DailyDiet::class)->withPivot('amount','snack2');
    }
}
