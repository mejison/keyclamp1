<?php

return [
    'trial_days' => 14,

    'plans' => [
        'price_1Jek64A3r5vdQMYQPg3LE6ty' => 'Pro — $20',
        'price_1Jek64A3r5vdQMYQu7A3WKpj' => 'Premium — $50',
    ],

    'cancelation_reasons' => [
        'Too expensive',
        'Lacks features',
        'Not what I expected',
    ],

    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
];
