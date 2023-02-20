<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileSpec extends Pivot
{
    protected $fillable = [
        'spec_id',
        'profile_id',
    ];
}
