<?php
declare(strict_types=1);

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/templates/',
            'cache_path' => __DIR__ . '/../cache/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'dashboard',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'google' => [
            'project_id' => getenv("DASHBOARD_PROJECT_ID"),
            'key_path' => getenv("DASHBOARD_KEY_PATH"),
        ]
    ],
];