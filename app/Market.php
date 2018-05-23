<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'name', 'market_type', 'key_currency', 'target_currency', 'rate', 'change', 'last', 'bid', 'ask', 'volume', 'high_24h', 'low_24h', 'minimum'
    ];
}
