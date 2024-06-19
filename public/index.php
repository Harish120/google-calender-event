<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\GoogleCalendarController;

session_start();

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/connect', 'GoogleCalendarController@connect');
$router->get('/oauth2callback', 'GoogleCalendarController@oauth2callback');
$router->get('/calendar', 'GoogleCalendarController@listEvents');
$router->post('/calendar/create', 'GoogleCalendarController@createEvent');
$router->post('/calendar/delete/{id}', 'GoogleCalendarController@deleteEvent');

$router->dispatch($_SERVER['REQUEST_URI']);
