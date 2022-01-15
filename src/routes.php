<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $app->get('/', function ( Request $request , Response $response ) {
        return $response->write('<p>go to <a href="/add">add</a>?</p>');
    });

    $app->get('/user/{id}', function ( Request $request , Response $response , $args ) {
        $user = require __DIR__ . '/../routes/user.php';
        return $user( $request, $response, $args );
    });

    $app->get('/users', function ( Request $request , Response $response , $args ) {
        $users = require __DIR__ . '/../routes/users.php';
        return $users( $request , $response , $args );
    });

    $app->any('/add', function ( Request $request , Response $response ) {
        $add = require __DIR__ . '/../routes/add.php';
        return $add( $request , $response );
    });
}
?>