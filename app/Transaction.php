<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'market_id', 'quantity', 'price', 'bid_order_id', 'ask_order_id'
    ];
}
