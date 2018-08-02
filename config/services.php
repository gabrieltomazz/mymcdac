<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '119388388770301',
        'client_secret' => 'f4db2fa5b1117c15c96ceb50ccc4e514',
        'redirect' => 'http://mcdac.rabelo.org/callback',
    ],
    'google' => [
        'client_id'     => '846826041732-bsgs9kinjmjgcs9kcl7k99qgkjn768el.apps.googleusercontent.com',
        'client_secret' => 'LDaNK-Hc8_yRez9HKDM1-3-I',
        'redirect'      => 'http://mcdac.rabelo.org/callbackGoogle'
    ]

];
