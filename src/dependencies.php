<?php
declare(strict_types=1);

use Google\Cloud\Datastore\DatastoreClient;

return [
    'factories' => [
        'db' => function (Psr\Container\ContainerInterface $c) {
            $db = new \Aura\Sql\ExtendedPdo(
                'mysql:host=127.0.0.1;port=3306;dbname=dashboard',
                // 'mysql:dbname=dashboard',
                'root',
                '',
                [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ]
            );
            $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            return $db;
        },

        'datastore' => function(Psr\Container\ContainerInterface $c) {
            return new DatastoreClient([
                'projectId' => $c->get('settings')['google']['project_id'],
                'keyFilePath' => $c->get('settings')['google']['key_path'],
            ]);
        },

        'logger' => function (Psr\Container\ContainerInterface $c) {
            $settings = $c->get('settings')['logger'];
            $logger = new Monolog\Logger($settings['name']);
            $logger->pushProcessor(new Monolog\Processor\UidProcessor());
            $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
            return $logger;
        },

        'view' => function (\RKA\ZsmSlimContainer\Container $c) {
            $settings = $c->get('settings');
            $view = new \Slim\Views\Twig($settings['renderer']['template_path'], [
                // 'cache' => $settings['renderer']['cache_path']
            ]);

            // Instantiate and add Slim specific extension
            $router = $c->get('router');
            $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
            $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

            return $view;
        },
    ],

    'abstract_factories' => [
        \Dashboard\Factory\AbstractFactory::class
    ],
];
