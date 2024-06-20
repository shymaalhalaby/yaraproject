<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyDiet extends Model
{
    use HasFactory;
    protected $fillable = ['member_id','status'];
    public function member():BelongsTo
    {
       return $this->belongsTo(member::class,'member_id');
    }
    public function breakfasts()
    {
        return $this->belongsToMany(Breakfast::class)->withPivot('amount','snack1');
    }
    public function Lunches()
    {
        return $this->belongsToMany(Lunch::class)->withPivot('amount','snack2');
    }

    public function Dinner()
    {
        return $this->belongsToMany(Dinner::class)->withPivot('amount','TotalCalories');
    }

}
