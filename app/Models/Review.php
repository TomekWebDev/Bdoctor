<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $table = 'reviews';

    protected $fillable = [
        'name',
        'review',
        'profile_id'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
