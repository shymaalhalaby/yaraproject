<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'image',
        'user_id',

      ];
      public function User(): BelongsTo
      {
          return $this->belongsTo(User::class);
      }
      
}
