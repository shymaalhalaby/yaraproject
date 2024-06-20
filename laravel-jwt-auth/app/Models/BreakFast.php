<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakFast extends Model
{
    use HasFactory;
    protected $table = 'break_fasts';
    protected $fillable = ['name'];
    public function DailyDiet()
    {
        return $this->belongsToMany(DailyDiet::class)->withPivot('amount','snack1');
    }


}
