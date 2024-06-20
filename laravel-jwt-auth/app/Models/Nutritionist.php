<?php

namespace App\Models;


use App\Models\member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nutritionist extends Model
{
    use HasFactory;

    /**
     * Get all of the post's comments.
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function members():BelongsToMany
    {
        return $this->belongsToMany(Member::class,'member_nutritionist')
                    ->using(member_nutritionist::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'WorkHours',
        'ProfileImage',
        'gender',
        'phone_number',
        'Age',
        'user_id',
    ];
}



