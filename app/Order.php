<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'market_id', 'bidask', 'order_type', 'quantity', 'price', 'condition', 'target_price', 'fee', 'total', 'timeinforce', 'balance', 'status'
    ];
}
