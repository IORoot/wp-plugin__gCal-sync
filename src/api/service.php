<?php

namespace andyp\gcal\api;

class service {

    public $client;
    public $options;
    public $items;
    public $calendars;
    public $results;

    public function set_client($client)
    {
        $this->client = $client;
    }

    public function set_options($options)
    {
        $this->options = $options;
    }

    public function get_events()
    {
        if (empty($this->options['calendarId'])){ 
            $this->options['calendarId'] = 'primary';
        }

        if (empty($this->options['maxResults'])){ 
            $this->options['maxResults'] = 10;
        }

        $client = $this->client;
        $service = new \Google_Service_Calendar($client);
        $calendarId = $this->options['calendarId'];
        $optParams = array(
            'maxResults' => $this->options['maxResults'],
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        );

        try {
            $this->result = $service->events->listEvents($calendarId, $optParams);
        } catch (Exception $e) {
            echo "unable to list events." . $e;
        }

    }

    public function get_calendarList()
    {
        $client = $this->client;
        $service = new \Google_Service_Calendar($client);

        try {
            $this->calendars = $service->calendarList->listCalendarList();
        } catch (Exception $e) {
            echo "unable to get calendars." . $e;
        }
        
    }

    public function get_results()
    {
        return $this->result;
    }

    public function get_calendars()
    {
        return $this->calendars;
    }

}