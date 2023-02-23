<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileSponsor extends Pivot
{
    protected $fillable = [
        'sponsor_id',
        'profile_id',
        'expiration_date',
    ];
}
