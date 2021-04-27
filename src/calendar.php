<?php

namespace andyp\gcal;

use andyp\gcal\acf\acf_update_calendarIds;

class calendar 
{

    private $scheduler;
    private $client;
    private $service;
    private $options;
    private $calendars;
    private $results;

    public function __construct($scheduler = false)
    {
        $this->scheduler = $scheduler;
        $this->get_client();
        $this->get_options();
        $this->get_service();
        $this->get_events();
        $this->get_calendars();
        $this->create_posts();
        $this->trash_old();
        $this->run_scheduler();

    }

    private function get_client()
    {
        $client = new api\client;
        $this->client = $client->get_client();
    }

    private function get_options()
    {
        $options = new acf\acf_get_options;
        $this->options = $options->get_options();
    }

    private function get_service()
    {
        $this->service = new api\service;
        $this->service->set_client($this->client);
        $this->service->set_options($this->options);
    }

    private function get_events()
    {
        $this->service->get_events();
        $this->results = $this->service->get_results();
    }

    private function get_calendars()
    {
        $this->service->get_calendarList();
        $this->calendars = $this->service->get_calendars();
        $cal = new acf_update_calendarIds($this->calendars);
    }

    private function create_posts()
    {
        $posts = new wp\posts;
        $posts->set_options($this->options);
        $posts->set_results($this->results);
        $posts->create();
    }

    private function run_scheduler()
    {
        // if the cron is running this class, don't redeclare the scheduler.
        if ($this->scheduler) {
            return;
        }
        $scheduler = new scheduler\schedule;
        $scheduler->set_options($this->options);
        $scheduler->run();
    }

    private function trash_old()
    {
        $posts = new wp\trash;
        $posts->set_options($this->options);
        $posts->run();
    }

    
}