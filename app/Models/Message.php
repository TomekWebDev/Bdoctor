<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';

    protected $fillable = [
        'message',
        'email',
        'name',
        'surname',
        'profile_id'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }
}
