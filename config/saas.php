<?php

return [
    'trial_days' => 14,

    'plans' => [
        'prod_KJp6iuOL6nWR8f' => 'Basic — $5',
        'prod_KJp5eBpaqV566m' => 'Standard — $10',
    ],

    'cancelation_reasons' => [
        'Too expensive',
        'Lacks features',
        'Not what I expected',
    ],

    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
];
