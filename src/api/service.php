<?php

namespace andyp\gcal\api;

class service {

    public $client;
    public $options;
    public $items;
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

        $this->result = $service->events->listEvents($calendarId, $optParams);

    }

    public function get_results()
    {
        return $this->result;
    }

}