<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositAddress extends Model
{
    protected $fillable = [
        'user_id', 'currency_id', 'address'
    ];
}
