<?php

namespace App\Controllers;

use App\Core\Controller;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Exception;

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

        // Fetching upcoming events
        $optParamsUpcoming = [
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        ];
        $upcomingEvents = $service->events->listEvents($calendarId, $optParamsUpcoming)->getItems();

        // Fetching archived events (older than current date up to 2 years)
        $optParamsArchived = [
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMax' => date('c', strtotime('-1 day')), // Today
            'timeMin' => date('c', strtotime('-2 years')), // 2 years ago
        ];
        $archivedEvents = $service->events->listEvents($calendarId, $optParamsArchived)->getItems();

        $this->view('calendar/list', [
            'upcomingEvents' => $upcomingEvents,
            'archivedEvents' => $archivedEvents
        ]);
    }

    public function showEventForm()
    {
        $this->view('calendar/create');
    }

    public function createEvent()
    {
        if (!isset($_SESSION['access_token'])) {
            header('Location: /connect');
            exit;
        }

        $this->client->setAccessToken($_SESSION['access_token']);
        $service = new Google_Service_Calendar($this->client);

        try {
            // Ensure the date and time are in the correct format
            $startDateTime = date('c', strtotime($_POST['start']));
            $endDateTime = date('c', strtotime($_POST['end']));

            // Create the event
            $event = new Google_Service_Calendar_Event([
                'summary' => $_POST['summary'],
                'start' => ['dateTime' => $startDateTime],
                'end' => ['dateTime' => $endDateTime],
            ]);

            $calendarId = 'primary';
            $event = $service->events->insert($calendarId, $event);

            // Debug print to ensure the event is created

            // Redirect to the calendar view
            header('Location: /calendar');
        } catch (Google_Service_Exception $e) {
            // Print detailed error for debugging
            echo 'Caught Google Service Exception: ',  $e->getMessage(), "\n";
            echo 'Response Body: ', $e->getErrors(), "\n";
        } catch (Exception $e) {
            // Catch any other errors
            echo 'Caught General Exception: ', $e->getMessage(), "\n";
        }
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
