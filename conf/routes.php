<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', 'App\Controller\HomeController:index')->setName('home');
    $app->get('/error', 'App\Controller\HomeController:error')->setName('error');
    $app->post('/upload', 'App\Controller\HomeController:uploadCSV')->setName('uploadCSV');
};
