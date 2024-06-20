<?php

namespace App\Models;

use App\Models\User;
use App\Models\coach;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class member extends Model
{
    use HasFactory;

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function coaches():BelongsToMany
    {
        return $this->belongsToMany(Coach::class,'coach_member')
                    ->using(coach_member::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }
    public function Nutritionists():BelongsToMany
    {
        return $this->belongsToMany(Nutritionist::class,'member_nutritionist')
                    ->using(member_nutritionist::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function DailyExercise():HasMany
    {
       return $this->hasMany(DailyExercise::class,'member_id');
    }
    

    public function DailyDiet():HasMany
    {
       return $this->hasMany(DailyDiet::class,'member_id');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'ProfileImage',
        'gender',
        'phone_number',
        'Age',
        'illness',
        'GOAL',
        'Physical_case',
        'Hieght',
        'Wieght',
        'target_Wieght',
        'AT',
        'user_id',
    ];
}
