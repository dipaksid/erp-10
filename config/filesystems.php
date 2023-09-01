<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'serviceform' => [
            'driver' => 'local',
            'root' => "/mnt/data/appfiles/SCANNING-DOC/CUSTOMER SERVICE FORMS",
            'url' => env('APP_URL').'/storage/serviceform',
            'visibility' => 'public',
        ],

        'uploaddo' => [
            'driver' => 'local',
            'root' => "/mnt/data/appfiles/SCANNING-DOC/UPLOAD DO",
            'url' => env('APP_URL').'/storage/uploaddo',
            'visibility' => 'public',
        ],

        'uploadpv' => [
            'driver' => 'local',
            'root' => "/mnt/data/appfiles/SCANNING-DOC/UPLOAD INV & PAYMENT VOUCHER",
            'url' => env('APP_URL').'/storage/uploadpv',
            'visibility' => 'public',
        ],

        'uploadbankdoc' => [
            'driver' => 'local',
            'root' => "/mnt/data/appfiles/SCANNING-DOC/UPLOAD BANKDOC",
            'url' => env('APP_URL').'/storage/uploadbankdoc',
            'visibility' => 'public',
        ],

        'app' => [
            'driver' => 'local',
            'root' => "/mnt/data/appfiles/APP",
            'url' => env('APP_URL').'/storage/apps',
            'visibility' => 'public',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
