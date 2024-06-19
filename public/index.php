<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

// Define routes
$router->get('/', 'HomeController@index');
$router->get('/user/{id}', 'UserController@show');

$router->dispatch($_SERVER['REQUEST_URI']);
