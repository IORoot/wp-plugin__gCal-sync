<?php

namespace andyp\gcal\acf;

class acf_update_calendarIds
{

    private $calendars;

    public function __construct($calendars)
    {
        $this->calendars = $calendars;

        $items = $this->calendars->getItems();

        foreach ($items as $item)
        {
            $choices[] = $item->getId();
        }

        $field = new acf_update_options_field;
        $field->set_field('calendarId');
        $field->set_value('choices', $choices);
        $field->run();

        return;
    }


}