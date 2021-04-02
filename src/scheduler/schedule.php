<?php

namespace andyp\gcal\scheduler;

class schedule
{

    public $options;

    public $results;


    public function set_options($options)
    {
        $this->options = $options;
    }


    public function run()
    {
        $this->cleanup_deleted_schedules();
        $this->loop_schedules();
        return $this->results;
    }



    /**
     * run_scheduler function
     * 
     * Loops through all scheduled starttimes
     *
     * @return void
     */
    private function loop_schedules()
    {   
        $time = time();
        if (!empty($event['schedule_starts'])){
            $time = $event['schedule_starts'];
        }

        /**
         * Loop through each schedule
         */
        foreach($this->options["schedule"] as $event)
        {
            $this->event = [
                'enabled' => $event['enabled'],
                'hook'    => 'gcal_sync',
                'params'  => [
                    'label' => $event['schedule_label']
                ],    
                'repeats' => $event['schedule_repeats'],
                'starts'  => $time, 
            ];

            $this->run_scheduler();
        }

    }


    /**
     * run_scheduler function
     * 
     * Runs the andyp\scheduler\sceduler standalone class
     * that schedules an event.
     *
     * @return void
     */
    private function run_scheduler()
    {
        $scheduler = new scheduler;
        $scheduler->set_options($this->event);
        $scheduler->run();
        $this->results['scheduler'][] = $scheduler->get_event();
    }




    /**
     * cleanup_deleted_schedules function
     * 
     * This will create a list of all labels for this job.
     * It will then match them against all registered jobs
     * in the cron.
     * If any are in the cron that are not in the list of
     * current labels, they will be deleted.
     * 
     * @return void
     */
    private function cleanup_deleted_schedules()
    {

        // Get all existing labels
        foreach( $this->options['schedule'] as $key => $event)
        {
            $labels[$key] = $event['schedule_label'];
        }


        // loop through all existing crons
        foreach (_get_cron_array() as $timestamp)
        {

            // IF not a pipeline_proceessor cron entry.
            if (!array_key_exists('gcal_sync', $timestamp)){ continue; }

            // get first key (its a unique MD5 hash)
            $event = reset($timestamp['gcal_sync']);

            // If label is in the list of existing labels, skip
            if (in_array($event['args']['label'], $labels)){ continue; }

            // Label NOT in list, so delete it.
            wp_clear_scheduled_hook( 'gcal_sync', $event['args'] );
        }

    }

}