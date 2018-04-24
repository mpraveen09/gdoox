<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'mg.gdoox.com',
        'secret' => 'key-69e0b4e5d8f4bb630944a2bc0b048aa6',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => 'AKIAI4373F6D7JT5CNJQ',
        'secret' => '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',
        'region' => 'us-west-2',
    ],

    'stripe' => [
        'model'  => Gdoox\User::class,
        'key'    => '',
        'secret' => '',
    ],

];
