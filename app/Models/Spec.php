<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile');
    }
}
