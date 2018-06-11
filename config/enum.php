<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 5/22/2018
 * Time: 2:55 PM
 */

return [
    'market_type' => [
        'BTC' => 'BTC',
        'ETH' => 'ETH'
    ],
    'bidask' => [
        'bid',
        'ask'
    ],
    'order_type' => [
        'Limit',
        'Conditional'
    ],
    'condition' => [
        'None' => 'None',
        'GOE' => 'Greater Than Or Equal To',
        'LOE' => 'Less Than Or Equal To'
    ],
    'timeinforce' => [
        'GTC' => 'Good Til Canceled',
        'IOC' => 'Immediate Or Cancel'
    ],
    'order_status' => [
        'opened',
        'closed',
        'canceled'
    ],
    'withdrawal_status' => [
        'pending',
        'complete'
    ]
];