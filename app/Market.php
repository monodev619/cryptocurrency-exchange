<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'name', 'market_type', 'currency_id', 'rate', 'change', 'last', 'bid', 'ask', 'volume', 'high_24h', 'low_24h', 'minimum'
    ];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
