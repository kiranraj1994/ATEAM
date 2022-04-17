<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;

    public function getUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'userId');
    }

    public function getGuest()
    {
        return $this->hasMany('App\Models\invitedUsers', 'eventId', 'id');
    }
}
