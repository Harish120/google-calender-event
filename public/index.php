<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

session_start();

$router = new Router();

// Define routes
$router->get('/', 'HomeController@index');
$router->get('/connect', 'GoogleCalendarController@connect');
$router->get('/oauth2callback', 'GoogleCalendarController@oauth2callback');
$router->get('/calendar', 'GoogleCalendarController@listEvents');
$router->get('/calendar/create', 'GoogleCalendarController@showEventForm');
$router->post('/calendar/create', 'GoogleCalendarController@createEvent');
$router->post('/calendar/delete/{id}', 'GoogleCalendarController@deleteEvent');
$router->get('/disconnect', 'GoogleCalendarController@disconnect');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
