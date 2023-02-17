<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{

    protected $table = 'sponsors';

    protected $fillable = [
        'name',
        'duration',
        'price'
    ];

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile');
    }
}
