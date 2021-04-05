<?php

namespace andyp\gcal\wp;

class posts
{
    public $options;
    public $results;

    public $items;
    public $item;
    public $start;
    public $end;
    public $meta;

    public $extra_fields;
    public $extra_meta;

    public function set_options($options)
    {
        $this->options = $options;
    }

    public function set_results($results)
    {
        $this->results = $results;
    }

    public function create()
    {
        if (empty($this->results)){ return; }

        $this->loop_items();

    }

    private function loop_items()
    {
        // needed for the scheduler.
        require_once( ABSPATH . 'wp-admin/includes/post.php' );

        $this->items = $this->results->getItems();

        foreach ( $this->items as $this->item )
        {
            $this->extra_fields();
            $this->class_injector();
            $this->insert_post();
        }

    }


    private function insert_post()
    {
        $this->start = $this->item->getStart();
        $startDateTime = $this->start->getDateTime();
        $startDateTime = str_replace('+01:00','',$startDateTime); // remove DST
        $timeZone = $this->start->getTimeZone();
        $startUnix = strtotime($startDateTime);

        $this->end = $this->item->getEnd();
        $endDateTime = $this->end->getDateTime();
        $endDateTime = str_replace('+01:00','',$endDateTime); // remove DST
        $endUnix = strtotime($endDateTime);

        $this->meta = array_merge([
            'timezone'         => $timeZone,
            'startDateTime'    => $startDateTime,
            'startUnix'        => $startUnix,
            'endDateTime'      => $endDateTime,
            'endUnix'          => $endUnix,
            'eventId'          => $this->item->getid(),
            'recurringEventId' => $this->item->getRecurringEventId(),
            'htmlLink'         => $this->item->getHtmlLink(),
            'title'            => $this->item->getSummary(),
            'raw_content'      => $this->item->getDescription(),
        ], $this->extra_meta);

        $post_arr = [ 
            "post_title"   => $this->create_title(),
            "post_content" => $this->post_content,
            "post_status"  => 'publish',
            "post_type"    => $this->options['post_type'],
            "meta_input"   => $this->meta
        ];

        // check if post already exists.
        // add ID to array - this will make wp_insert_post update instead of insert if anything other than 0 is returned.
        $post_arr['ID'] = \post_exists($this->create_title());
        if ($post_arr['ID']){
            // don't set the status because theres already one set on the existing post.
            // otherwise all posts will constantly be updated to published.
            $status = get_post_status($post_arr['ID']);
            $post_arr['post_status'] = $status;
        }

        $post = \wp_insert_post($post_arr);

        if (!empty($this->image)){
            \set_post_thumbnail($post, $this->image['ID']);
        }

    }


    private function create_title()
    {
        $title = $this->item->getSummary() . ' ';
        $title .= date("d-m-Y", strtotime($this->start->getDateTime()));    
        return $title;
    }


    private function extra_fields()
    {

        foreach ($this->options['extra_fields'] as $this->extra_fields){

            if (strtolower($this->extra_fields['event_title_match']) != strtolower($this->item->getSummary())){
                continue;
            }

            $this->add_meta_fields();
            $this->set_image();

        }

    }


    private function class_injector()
    {
        $this->post_content = $this->item->getDescription();

        foreach($this->options['regex_replace'] as $regex)
        {
            $this->post_content = preg_replace($regex['Pattern'], $regex['replacement'], $this->post_content);
        }

    }


    private function add_meta_fields()
    {
        foreach($this->extra_fields['meta_fields'] as $meta_field)
        {
            $this->extra_meta[$meta_field['additional_field_key']] = $meta_field['additional_field_value'];
        }
    }


    private function set_image()
    {
        $this->image = $this->extra_fields['featured_image'];
    }

    

}