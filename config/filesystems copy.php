<?php

return [

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => '/home/dreyadar/public_html', // Base path to your project
        ],

        'public_html' => [
            'driver' => 'local',
            'root'   => '/home/dreyadar/public_html/public_html', // Root to your public_html directory
            'url' => env('APP_URL') . '/public_html',
            'visibility' => 'public',
        ],

        'public_images' => [
            'driver' => 'local',
            'root' => '/home/dreyadar/public_html/public', // Root to your public directory
            'url' => env('APP_URL'), // Adjust the URL prefix if needed
            'visibility' => 'public',
        ],

        'public' => [
            'driver' => 'local',
            'root'   => '/home/dreyadar/public_html/public/uploads', // Root to the uploads folder in public
            'url' => env('APP_URL') . '/uploads',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
