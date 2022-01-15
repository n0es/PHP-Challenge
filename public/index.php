<?php
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware; 

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();
$container = $app->getContainer();

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('../templates', [
        'cache' => '../cache'
    ]);

    $basePath = rtrim( str_ireplace( 'index.php', '', $c['request']->getUri()->getBasePath()) , '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath ));

    return $view;
};

$routes = require __DIR__ . '/../src/routes.php';
$routes( $app );

$app->run();
?>