<?php

namespace andyp\gcal;

class initialise {


    public function __construct()
    {

        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                            Include Field Groups    	        	     │
        // └─────────────────────────────────────────────────────────────────────────┘
        require __DIR__.'/acf/acf_admin_page.php';
        require __DIR__.'/acf/acf_field_groups.php';
        require __DIR__.'/acf/acf_on_update.php';

        //  ┌─────────────────────────────────────────────────────────────────────────┐
        //  │                         The Schedules Filter                            │
        //  └─────────────────────────────────────────────────────────────────────────┘
        new scheduler\add_schedules;

    }

}