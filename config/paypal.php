<?php
return [
    // Client ID
    'client_id' => env('PAYPAL_CLIENT_ID'),
    // Client Secret
    'secret' => env('PAYPAL_SECRET'),
    'settings' => [
        // PayPal mode, sanbox or live
        'mode' => env('PAYPAL_MODE'),
        // Time limit per session, in second
        'http.ConnectionTimeOut' => 30,
        // Enable log
        'log.logEnabled' => true,
        // 
        'log.FileName' => storage_path() . '/logs/paypal.log',
        // Type
        'log.LogLevel' => 'FINE'
    ],
];