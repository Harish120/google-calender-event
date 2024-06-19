<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

// Define routes
$router->get('/', 'HomeController@index');
$router->get('/connect', 'GoogleCalendarController@connect');
$router->get('/oauth2callback', 'GoogleCalendarController@oauth2callback');
$router->get('/calendar', 'GoogleCalendarController@listEvents');

$router->dispatch($_SERVER['REQUEST_URI']);
