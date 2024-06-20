<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BreakFastDailyDiet extends Pivot
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'break_fast_daily_diets';
    protected $fillable = [
        'daily_diet_id',
        'break_fast_id',
        'amount',
        'snack1'
    ];
    public function breakfastdetails(): BelongsTo
    {
        return $this->belongsTo(BreakFast::class,'break_fast_id');
    }
}
