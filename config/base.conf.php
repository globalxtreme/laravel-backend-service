<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Base Prefix & Namespace
     |--------------------------------------------------------------------------
     |
     | Set up base endpoint for web and mobile (default)
     | Set up base namespace controller for web and mobile (default)
     |
     */

    'prefix' => [

        'web' => env('BASE_WEB_PREFIX', 'web'),

        'mobile' => env('BASE_MOBILE_PREFIX', 'mobile'),

    ],

    'namespace' => [

        'web' => env('BASE_WEB_NAMESPACE', 'Web'),

        'mobile' => env('BASE_MOBILE_NAMESPACE', 'Mobile'),

    ]

];
