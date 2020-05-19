<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Twig\Loader\FilesystemLoader;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
    ]);
    $containerBuilder->addDefinitions([
        Twig::class => function (ContainerInterface $c) {
            $settings       = $c->get('settings');
            $twigSettings   = $settings['twig'];

            $loader = new FilesystemLoader(
                $twigSettings['path_templates']
            );
            $options = [
                'cache' => $twigSettings['path_cache']
            ];

            $view = new Twig(
                $loader,
                $options
            );

            return $view;
        },
    ]);
};
