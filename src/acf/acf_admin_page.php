<?php


add_action('acf/init', 'menu_gcal_importer');

function menu_gcal_importer(){

    if (function_exists('acf_add_options_page')) {
        $args = array(
            /* (string) The title displayed on the options page. Required. */
            'page_title' => '<svg viewBox="0 0 24 24" style="height:1.3em; vertical-align:text-bottom; fill:#1E3A8A;" xmlns="http://www.w3.org/2000/svg"><path d="M19,20V9H5V20H19M16,2H18V4H19A2,2 0 0,1 21,6V20A2,2 0 0,1 19,22H5A2,2 0 0,1 3,20V6A2,2 0 0,1 5,4H6V2H8V4H16V2M12,18.17L11.42,17.64C9.36,15.77 8,14.54 8,13.03C8,11.8 8.97,10.83 10.2,10.83C10.9,10.83 11.56,11.15 12,11.66C12.44,11.15 13.1,10.83 13.8,10.83C15.03,10.83 16,11.8 16,13.03C16,14.54 14.64,15.77 12.58,17.64L12,18.17Z"/></svg> gCal Importer',
            
            /* (string) The title displayed in the wp-admin sidebar. Defaults to page_title */
            'menu_title' => '<svg viewBox="0 0 24 24" style="height:1.3em; vertical-align:text-bottom; fill:#1E3A8A;" xmlns="http://www.w3.org/2000/svg"><path d="M19,20V9H5V20H19M16,2H18V4H19A2,2 0 0,1 21,6V20A2,2 0 0,1 19,22H5A2,2 0 0,1 3,20V6A2,2 0 0,1 5,4H6V2H8V4H16V2M12,18.17L11.42,17.64C9.36,15.77 8,14.54 8,13.03C8,11.8 8.97,10.83 10.2,10.83C10.9,10.83 11.56,11.15 12,11.66C12.44,11.15 13.1,10.83 13.8,10.83C15.03,10.83 16,11.8 16,13.03C16,14.54 14.64,15.77 12.58,17.64L12,18.17Z"/></svg> gCal Importer',
            
            /* (string) The URL slug used to uniquely identify this options page.
            Defaults to a url friendly version of menu_title */
            'menu_slug' => 'gcal_importer',
            
            /* (string) The capability required for this menu to be displayed to the user. Defaults to edit_posts.
            Read more about capability here: http://codex.wordpress.org/Roles_and_Capabilities */
            'capability' => 'manage_options',
            
            /* (int|string) The position in the menu order this menu should appear.
            WARNING: if two menu items use the same position attribute, one of the items may be overwritten so that only one item displays!
            Risk of conflict can be reduced by using decimal instead of integer values, e.g. '63.3' instead of 63 (must use quotes).
            Defaults to bottom of utility menu items */
            'position' => 8,
            
            /* (string) The slug of another WP admin page. if set, this will become a child page. */
            'parent_slug' => 'andyp',
            
            /* (string) The icon class for this menu. Defaults to default WordPress gear.
            Read more about dashicons here: https://developer.wordpress.org/resource/dashicons/ */
            'icon_url' => 'dashicons-screenoptions',
            
            /* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists).
            If set to false, this parent page will appear alongside any child pages. Defaults to true */
            'redirect' => true,
            
            /* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2').
            Defaults to 'options'. Added in v5.2.7 */
            'post_id' => 'options',
            
            /* (boolean)  Whether to load the option (values saved from this options page) when WordPress starts up.
            Defaults to false. Added in v5.2.8. */
            'autoload' => false,
            
            /* (string) The update button text. Added in v5.3.7. */
            'update_button'		=> __('Update', 'acf'),
            
            /* (string) The message shown above the form on submit. Added in v5.6.0. */
            'updated_message'	=> __("Options Updated", 'acf'),
                    
        );

        acf_add_options_sub_page($args);
    }
}