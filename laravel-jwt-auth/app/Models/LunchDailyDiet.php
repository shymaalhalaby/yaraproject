<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LunchDailyDiet extends Pivot
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'lunch_daily_diets';
    protected $fillable = [
        'daily_diet_id',
        'lunch_id',
        'amount',
        'snack2'
    ];
    public function lunchdetails(): BelongsTo
    {
        return $this->belongsTo(Lunch::class,'lunch_id');
    }
}
