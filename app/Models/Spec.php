<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{

    protected $fillable = [
        'name'
    ];

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile');
    }
}
