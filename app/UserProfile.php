<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'photo', 'dob', 'country', 'street', 'apt', 'city', 'state', 'zipcode', 'phone'
    ];


}
