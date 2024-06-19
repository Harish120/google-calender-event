<?php

namespace App\Controllers;

use App\Core\Controller;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(__DIR__ . '/../../config/credentials.json');
        $this->client->setRedirectUri('http://localhost:8000/oauth2callback');
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
    }

    public function connect()
    {
        $authUrl = $this->client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    }

    public function oauth2callback()
    {
        if (!isset($_GET['code'])) {
            header('Location: /');
            exit;
        }

        $this->client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $this->client->getAccessToken();
        header('Location: /calendar');
    }

    public function listEvents()
    {
        if (!isset($_SESSION['access_token'])) {
            header('Location: /connect');
            exit;
        }

        $this->client->setAccessToken($_SESSION['access_token']);
        $service = new Google_Service_Calendar($this->client);

        $calendarId = 'primary';
        $events = $service->events->listEvents($calendarId);
        $eventsArray = $events->getItems();

        $this->view('calendar/list', ['events' => $eventsArray]);
    }
    public function createEvent()
    {
        if (!isset($_SESSION['access_token'])) {
            header('Location: /connect');
            exit;
        }

        $this->client->setAccessToken($_SESSION['access_token']);
        $service = new Google_Service_Calendar($this->client);

        $event = new Google_Service_Calendar_Event([
            'summary' => 'New Event',
            'start' => ['dateTime' => '2024-06-20T09:00:00-07:00'],
            'end' => ['dateTime' => '2024-06-20T10:00:00-07:00']
        ]);

        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);
        header('Location: /calendar');
    }

    public function deleteEvent($eventId)
    {
        if (!isset($_SESSION['access_token'])) {
            header('Location: /connect');
            exit;
        }

        $this->client->setAccessToken($_SESSION['access_token']);
        $service = new Google_Service_Calendar($this->client);

        $calendarId = 'primary';
        $service->events->delete($calendarId, $eventId);
        header('Location: /calendar');
    }

    public function disconnect()
    {
        unset($_SESSION['access_token']);
        header('Location: /');
    }
}
