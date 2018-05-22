<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id', 'currency_id', 'address', 'quantity', 'fee', 'total', 'txid', 'status'
    ];
}
