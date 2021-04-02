<?php

/**
 * On save of options page, run.
 */
function save_gcal_options()
{
    $screen = get_current_screen();

    if ($screen->id != "toplevel_page_gcal_importer") {
        return;
    }
        
    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                           Kick off the program                          │
    // └─────────────────────────────────────────────────────────────────────────┘
    $cal = new \andyp\gcal\calendar;
}


// MUST be in a hook
add_action('acf/save_post', 'save_gcal_options', 20);

