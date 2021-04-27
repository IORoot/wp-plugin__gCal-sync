<?php

namespace andyp\gcal\acf;

/**
 * update_acf_options_field
 * 
 * Updates an option field data. Good for
 * update select fields on the fly.
 * 
 * https://support.advancedcustomfields.com/forums/topic/updating-field-settings-in-php/
 */
class acf_update_options_field
{

    private $field;

    private $value;

    private $response;

    public function set_field($field)
    {
        $field = acf_get_field( $field );
        $field_key = $field['key'];

        $this->field = \get_field_object($field_key, 'option');
    }

    public function set_value($param, $value)
    {
        $this->field[$param] = $value;
    }

    public function run()
    {
        $result = \acf_update_field($this->field);
    }

}