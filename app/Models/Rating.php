<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    protected $table = 'ratings';

    protected $fillable = [
        'vote',
    ];


    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile');
    }
}
