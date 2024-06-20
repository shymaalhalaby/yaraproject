<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DinnerDailyDiet extends Pivot
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'dinner_daily_diets';
    protected $fillable = [
        'daily_diet_id',
        'dinner_id',
        'amount',
        'TotalCalories'
    ];
    public function dinnerdetails(): BelongsTo
    {
        return $this->belongsTo(Dinner::class,'dinner_id');
    }
}
