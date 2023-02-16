<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
