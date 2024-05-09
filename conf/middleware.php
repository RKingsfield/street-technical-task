<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\TwigMiddleware;

return function (App $app) {
    $container = $app->getContainer();
    $settings = $container->get('settings');

    $app->add(TwigMiddleware::createFromContainer($app));

    $app->add(new \App\Middleware\BaseUrlMiddleware($app->getBasePath()));

    $app->add(new \RKA\Middleware\ProxyDetection());

    if ($settings['debug'] == true) {
        $app->add(new RunTracy\Middlewares\TracyMiddleware($app));
    }
};
