<?php

namespace andyp\gcal\acf;

class acf_get_options
{

    public function get_options()
    {
        $result = [];
        $result = array_merge($result,  get_field('gcal_calendar', 'option', true));
        $result = array_merge($result,  get_field('gcal_posts', 'option', true));
        $result['extra_fields'] = get_field('extra_fields', 'option', true);
        $result['regex_replace'] = get_field('regex_replace', 'option', true);
        $result['schedule'] = get_field('schedule', 'option', true);
        $result['trash_seconds'] = get_field('trash_seconds', 'option', true);

        return $result;
    }


}