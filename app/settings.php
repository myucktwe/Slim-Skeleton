<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            'twig' => [
                'path_templates' => __DIR__ . '/../templates',
                'path_cache' => false
            ],
            'database' => [
                'host' => 'localhost',
                'port' => '5432',
                'database' => 'stocks',
                'user' => 'postgres',
                'password' => 'postgres',
            ],
        ],
    ]);
};
