<?php

namespace andyp\gcal\wp;

class trash
{
    public $options;
    public $posts;

    public function set_options($options)
    {
        $this->options = $options;
    }

    public function run()
    {
        if (empty($this->options)){ return; }

        $this->get_old_posts();
        $this->trash_old_posts();

    }



    private function get_old_posts()
    {
        // needed for the scheduler.
        require_once( ABSPATH . 'wp-admin/includes/post.php' );

        $time_minus_trash = time() - $this->options['trash_seconds'];

        $args = [
            'post_type' => $this->options['post_type'],
            'post_status' => 'publish',
            'posts_per_page' => 50,
            'meta_query' => [
                [
                    'key' => 'startUnix',
                    'value' => $time_minus_trash,
                    'compare' => '<',
                    'type' => 'NUMERIC'
                ]
            ]
        ];

        $this->posts = get_posts($args);
    }


    private function trash_old_posts()
    {
        foreach($this->posts as $post)
        {
            wp_trash_post($post->ID);
        }
    }


    

}