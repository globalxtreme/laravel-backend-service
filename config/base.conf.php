<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Version & Service
     |--------------------------------------------------------------------------
     |
     | 1. Default version is v1. You can set up versioning in directories
     |    Algorithms, Controllers, Requests, Models and routes
     | 2. Set your service name, using kebab case. Ex: customer-support, work-order
     |
     */

    'version' => env('VERSION', 'v1'),

    'service' => env('SERVICE_NAME', ''),


    /*
     |--------------------------------------------------------------------------
     | Base Prefix & Namespace
     |--------------------------------------------------------------------------
     |
     | Set up base endpoint for web, mobile and third party (default)
     | Set up base namespace controller for web, mobile and third party (default)
     |
     */

    'prefix' => [

        'web' => env('BASE_WEB_PREFIX', 'api/web'),

        'mobile' => env('BASE_MOBILE_PREFIX', 'api/mobile'),

        'third_party' => env('BASE_THIRD_PARTY_PREFIX', 'api/third'),

    ],

    'namespace' => [

        'web' => env('BASE_WEB_NAMESPACE', 'Web'),

        'mobile' => env('BASE_MOBILE_NAMESPACE', 'Mobile'),

        'third_party' => env('BASE_THIRD_PARTY_NAMESPACE', 'ThirdParty'),

    ]

];
