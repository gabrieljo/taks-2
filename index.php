<?php

use Slim\App;
use Controller\HomeController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$app = new App();
$controller = new HomeController();

//The router dispatches the request to a controller via a defined entry point method called execute.
$app->get('/', function(Request $request, Response $response) use($controller){
    return $controller->execute($request, $response);
});

$app->post('/', function(Request $request, Response $response) use($controller){
    return $controller->execute($request, $response);
});

$app->put('/', function(Request $request, Response $response) use($controller){
    return $controller->execute($request, $response);
});

$app->run();
