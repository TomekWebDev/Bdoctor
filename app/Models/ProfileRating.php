<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileRating extends Pivot
{
    protected $fillable = [
        'rating_id',
        'profile_id'
    ];
}
