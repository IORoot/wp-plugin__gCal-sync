<?php

namespace andyp\gcal\hooks;

class action_gcal_sync {


    public function __construct()
    {
        add_action( 'gcal_sync', array($this,'run_gcal_sync'), 10, 0);
    }
    
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                           Kick off the program                          │
    // └─────────────────────────────────────────────────────────────────────────┘
    public function run_gcal_sync(){
        $cal = new \andyp\gcal\calendar(TRUE);
    }
    
}