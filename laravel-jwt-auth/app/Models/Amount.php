<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amount extends Model
{
    use HasFactory;
    protected $table = 'amounts';
    protected $fillable = [
        'amount',
    ];
    public function Plane():HasMany
    {
       return $this->hasMany(BreakFast::class,'exercise_id');
    }
}
