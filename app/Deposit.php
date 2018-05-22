<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id', 'currency_id', 'address', 'amount', 'is_confirmed', 'txid'
    ];
}
