<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function sponsors()
    {
        return $this->belongsToMany('App\Models\Sponsor');
    }

    public function specs()
    {
        return $this->belongsToMany('App\Models\Spec');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Models\Rating');
    }
}
