<?php
declare(strict_types=1);
// This is a temporary hack

date_default_timezone_set('UTC');

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// Move this into middleware
session_start();

// Set up settings
$settings = require __DIR__ . '/../src/settings.php';

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';

// Instantiate the app
$container = new RKA\ZsmSlimContainer\Container($settings + $dependencies);
$app = new \Slim\App($container);

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
try {
    $app->run();
} catch (Exception $e) {
    error_log($e->getMessage());
}