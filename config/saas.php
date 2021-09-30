<?php

return [
    'trial_days' => 14,

    'plans' => [
        'price_1JfCkEK083iokL2qONfLOivP' => 'Basic — $5',
        'price_1JfCmaK083iokL2q6alghCtr' => 'Standard — $10',
    ],

    'cancelation_reasons' => [
        'Too expensive',
        'Lacks features',
        'Not what I expected',
    ],

    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
];
